(function () {
    const pdfjsLib = window.pdfjsLib;

    const params = new URLSearchParams(window.location.search);
    const PDF_URL = params.get("file") || "standalone/PDF/portfolio.pdf";
    const INITIAL_PAGE = Math.max(
        1,
        Number.parseInt(params.get("page") || "1", 10) || 1,
    );
    const INITIAL_SCALE = 1.15;
    const MIN_SCALE = 0.4;
    const MAX_SCALE = 4.0;
    const SCALE_STEP = 0.15;

    const canvas = document.getElementById("pdfCanvas");
    const ctx = canvas.getContext("2d", { alpha: false });
    const pageSurface = document.getElementById("pageSurface");
    const viewerContainer = document.getElementById("viewerContainer");
    const loadingState = document.getElementById("loadingState");

    const prevPageBtn = document.getElementById("prevPageBtn");
    const nextPageBtn = document.getElementById("nextPageBtn");
    const pageNumberInput = document.getElementById("pageNumberInput");
    const pageCount = document.getElementById("pageCount");
    const zoomOutBtn = document.getElementById("zoomOutBtn");
    const zoomInBtn = document.getElementById("zoomInBtn");
    const fitWidthBtn = document.getElementById("fitWidthBtn");
    const fitHeightBtn = document.getElementById("fitHeightBtn");
    const printBtn = document.getElementById("printBtn");

    let pdfDoc = null;
    let currentPage = INITIAL_PAGE;
    let currentScale = INITIAL_SCALE;
    let fitMode = getDefaultFitMode();
    let renderTask = null;
    let lastRenderToken = 0;
    let nativeFrame = null;
    let isNativeFallback = false;

    function getDefaultFitMode() {
        return window.innerWidth < window.innerHeight ? "width" : "height";
    }

    function setLoading(visible, message) {
        loadingState.textContent = message || "読み込み中...";
        loadingState.classList.toggle("is-hidden", !visible);
    }

    function clamp(value, min, max) {
        return Math.min(max, Math.max(min, value));
    }

    function getContainerSize() {
        const style = getComputedStyle(viewerContainer);
        const paddingX =
            Number.parseFloat(style.paddingLeft) +
            Number.parseFloat(style.paddingRight);
        const paddingY =
            Number.parseFloat(style.paddingTop) +
            Number.parseFloat(style.paddingBottom);
        const width = Math.max(280, viewerContainer.clientWidth - paddingX - 2);
        const height = Math.max(280, viewerContainer.clientHeight - paddingY - 2);
        return { width, height };
    }

    function syncFitButtonState() {
        fitWidthBtn.classList.toggle("is-active", fitMode === "width");
        fitHeightBtn.classList.toggle("is-active", fitMode === "height");
    }

    function updateToolbar() {
        const total = pdfDoc && pdfDoc.numPages ? pdfDoc.numPages : 0;
        pageCount.textContent = String(total || (isNativeFallback ? "?" : 0));
        pageNumberInput.value = String(currentPage || "");
        pageNumberInput.max = String(total || 9999);
        prevPageBtn.disabled = isNativeFallback ? currentPage <= 1 : !pdfDoc || currentPage <= 1;
        nextPageBtn.disabled = isNativeFallback ? false : !pdfDoc || currentPage >= total;
        zoomOutBtn.disabled = isNativeFallback || currentScale <= MIN_SCALE + 0.001;
        zoomInBtn.disabled = isNativeFallback || currentScale >= MAX_SCALE - 0.001;
        fitWidthBtn.disabled = isNativeFallback || !pdfDoc;
        fitHeightBtn.disabled = isNativeFallback || !pdfDoc;
        printBtn.disabled = false;
        syncFitButtonState();
    }

    function getScaleForFit(page) {
        const baseViewport = page.getViewport({ scale: 1 });
        const size = getContainerSize();

        if (fitMode === "width") {
            return clamp(size.width / baseViewport.width, MIN_SCALE, MAX_SCALE);
        }

        if (fitMode === "height") {
            return clamp(size.height / baseViewport.height, MIN_SCALE, MAX_SCALE);
        }

        return clamp(currentScale, MIN_SCALE, MAX_SCALE);
    }

    function buildNativePdfUrl(pageNumber) {
        return PDF_URL + "#page=" + pageNumber;
    }

    function updateNativeFrame(pageNumber) {
        currentPage = Math.max(1, pageNumber || 1);
        if (nativeFrame) {
            nativeFrame.src = buildNativePdfUrl(currentPage);
        }
        updateToolbar();
    }

    function enableNativeFallback(message) {
        isNativeFallback = true;
        pageSurface.innerHTML = "";
        pageSurface.style.width = "100%";
        pageSurface.style.height = "100%";
        pageSurface.style.minHeight = "70vh";

        nativeFrame = document.createElement("iframe");
        nativeFrame.setAttribute("title", "PDF ビューア");
        nativeFrame.src = buildNativePdfUrl(currentPage);
        nativeFrame.style.width = "100%";
        nativeFrame.style.height = "100%";
        nativeFrame.style.minHeight = "70vh";
        nativeFrame.style.border = "0";
        nativeFrame.style.background = "#ffffff";
        pageSurface.appendChild(nativeFrame);

        setLoading(false);
        updateToolbar();
    }

    async function renderPage(pageNumber) {
        if (!pdfDoc) return;

        currentPage = clamp(pageNumber || currentPage, 1, pdfDoc.numPages);
        updateToolbar();
        setError("");
        setLoading(true, "ページ " + currentPage + " を描画中...");

        const token = ++lastRenderToken;
        if (renderTask) {
            try {
                renderTask.cancel();
            } catch {
                // no-op
            }
            renderTask = null;
        }

        try {
            const page = await pdfDoc.getPage(currentPage);

            if (fitMode) {
                currentScale = getScaleForFit(page);
                updateToolbar();
            } else {
                currentScale = clamp(currentScale, MIN_SCALE, MAX_SCALE);
            }

            const viewport = page.getViewport({ scale: currentScale });
            const outputScale = Math.max(1, window.devicePixelRatio || 1);

            canvas.width = Math.ceil(viewport.width * outputScale);
            canvas.height = Math.ceil(viewport.height * outputScale);
            canvas.style.width = viewport.width + "px";
            canvas.style.height = viewport.height + "px";

            pageSurface.style.width = viewport.width + "px";
            pageSurface.style.height = viewport.height + "px";

            const transform =
                outputScale === 1 ? null : [outputScale, 0, 0, outputScale, 0, 0];

            renderTask = page.render({
                canvasContext: ctx,
                viewport: viewport,
                transform: transform,
                annotationMode: pdfjsLib.AnnotationMode.ENABLE,
                intent: "display",
            });

            await renderTask.promise;

            if (token !== lastRenderToken) return;
            setLoading(false);
        } catch (error) {
            if (error && error.name === "RenderingCancelledException") {
                return;
            }
            console.error(error);
            setLoading(false);
            setError(
                "PDF の表示に失敗しました。サーバー配信か、PDF ファイルの配置を確認してください。",
            );
        } finally {
            renderTask = null;
        }
    }

    function goToPage(pageNumber) {
        if (isNativeFallback) {
            updateNativeFrame(pageNumber);
            return;
        }
        if (!pdfDoc) return;
        currentPage = clamp(pageNumber, 1, pdfDoc.numPages);
        renderPage(currentPage);
    }

    function changeScale(nextScale) {
        if (isNativeFallback) return;
        fitMode = null;
        currentScale = clamp(nextScale, MIN_SCALE, MAX_SCALE);
        updateToolbar();
        renderPage(currentPage);
    }

    function fitToWidth() {
        if (isNativeFallback) return;
        fitMode = "width";
        updateToolbar();
        renderPage(currentPage);
    }

    function fitToHeight() {
        if (isNativeFallback) return;
        fitMode = "height";
        updateToolbar();
        renderPage(currentPage);
    }

    function printPdf() {
        if (isNativeFallback || !pdfDoc) {
            const target = window.open(PDF_URL, "_blank");
            if (!target) {
                window.location.href = PDF_URL;
            }
            return;
        }

        const printFrame = document.createElement("iframe");
        printFrame.style.position = "fixed";
        printFrame.style.right = "0";
        printFrame.style.bottom = "0";
        printFrame.style.width = "0";
        printFrame.style.height = "0";
        printFrame.style.border = "0";
        printFrame.src = PDF_URL;

        const cleanup = function () {
            window.setTimeout(function () {
                printFrame.remove();
            }, 1000);
        };

        printFrame.onload = function () {
            try {
                if (printFrame.contentWindow) {
                    printFrame.contentWindow.focus();
                    printFrame.contentWindow.print();
                }
            } finally {
                cleanup();
            }
        };

        document.body.appendChild(printFrame);
    }

    async function init() {
        setLoading(true, "PDF を読み込み中...");

        if (window.location.protocol === "file:") {
            enableNativeFallback();
            return;
        }

        if (!pdfjsLib || typeof pdfjsLib.getDocument !== "function") {
            enableNativeFallback(
                "PDF.js の読み込みに失敗したため、埋め込み PDF 表示へ切り替えました。",
            );
            return;
        }

        try {
            const loadingTask = pdfjsLib.getDocument({
                url: PDF_URL,
                useSystemFonts: true,
                enableXfa: false,
                standardFontDataUrl: "external/standard_fonts/",
                cMapUrl: "external/cmaps/",
                cMapPacked: true,
            });

            pdfDoc = await loadingTask.promise;
            currentPage = clamp(INITIAL_PAGE, 1, pdfDoc.numPages);
            updateToolbar();
            await renderPage(currentPage);
        } catch (error) {
            console.error(error);
            enableNativeFallback(
                "PDF.js で読み込めなかったため、埋め込み PDF 表示へ切り替えました。HTTP サーバー経由なら PDF.js 表示に戻せます。",
            );
        }
    }

    prevPageBtn.addEventListener("click", function () {
        goToPage(currentPage - 1);
    });
    nextPageBtn.addEventListener("click", function () {
        goToPage(currentPage + 1);
    });
    zoomOutBtn.addEventListener("click", function () {
        changeScale(currentScale - SCALE_STEP);
    });
    zoomInBtn.addEventListener("click", function () {
        changeScale(currentScale + SCALE_STEP);
    });
    fitWidthBtn.addEventListener("click", fitToWidth);
    fitHeightBtn.addEventListener("click", fitToHeight);
    printBtn.addEventListener("click", printPdf);

    pageNumberInput.addEventListener("change", function () {
        const value = Number.parseInt(pageNumberInput.value, 10);
        if (Number.isNaN(value)) {
            pageNumberInput.value = String(currentPage);
            return;
        }
        goToPage(value);
    });

    pageNumberInput.addEventListener("keydown", function (event) {
        if (event.key === "Enter") {
            pageNumberInput.blur();
        }
    });

    window.addEventListener("keydown", function (event) {
        const metaOrCtrl = event.ctrlKey || event.metaKey;

        if (metaOrCtrl && event.key.toLowerCase() === "s") {
            event.preventDefault();
        }

        if (metaOrCtrl && event.key.toLowerCase() === "p") {
            event.preventDefault();
            printPdf();
            return;
        }

        if (document.activeElement === pageNumberInput) return;

        if (event.key === "ArrowLeft") goToPage(currentPage - 1);
        if (event.key === "ArrowRight") goToPage(currentPage + 1);
    });

    canvas.addEventListener("contextmenu", function (event) {
        event.preventDefault();
    });

    let resizeTimer = null;
    window.addEventListener("resize", function () {
        if (isNativeFallback || !pdfDoc) return;
        window.clearTimeout(resizeTimer);
        resizeTimer = window.setTimeout(function () {
            if (!fitMode && !canvas.width) return;
            renderPage(currentPage);
        }, 120);
    });

    init();
})();
