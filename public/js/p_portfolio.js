import * as pdfjsLib from 'https://cdn.jsdelivr.net/npm/pdfjs-dist@5.6.205/build/pdf.min.mjs';

const PDFJS_CDN_BASE = 'https://cdn.jsdelivr.net/npm/pdfjs-dist@5.6.205/';

pdfjsLib.GlobalWorkerOptions.workerSrc = `${PDFJS_CDN_BASE}build/pdf.worker.min.mjs`;

const params = new URLSearchParams(window.location.search);
const PDF_URL = params.get('file') || '../standalone/PDF/portfolio.pdf';
const INITIAL_PAGE = Math.max(1, Number.parseInt(params.get('page') || '1', 10) || 1);
const INITIAL_SCALE = 1.15;
const MIN_SCALE = 0.4;
const MAX_SCALE = 4.0;
const SCALE_STEP = 0.15;

const canvas = document.getElementById('pdfCanvas');
const ctx = canvas.getContext('2d', { alpha: false });
const pageSurface = document.getElementById('pageSurface');
const viewerContainer = document.getElementById('viewerContainer');
const loadingState = document.getElementById('loadingState');
const errorState = document.getElementById('errorState');

const prevPageBtn = document.getElementById('prevPageBtn');
const nextPageBtn = document.getElementById('nextPageBtn');
const pageNumberInput = document.getElementById('pageNumberInput');
const pageCount = document.getElementById('pageCount');
const zoomOutBtn = document.getElementById('zoomOutBtn');
const zoomInBtn = document.getElementById('zoomInBtn');
const fitWidthBtn = document.getElementById('fitWidthBtn');
const fitHeightBtn = document.getElementById('fitHeightBtn');
const printBtn = document.getElementById('printBtn');

let pdfDoc = null;
let currentPage = INITIAL_PAGE;
let currentScale = INITIAL_SCALE;
let fitMode = getDefaultFitMode();
let renderTask = null;
let lastRenderToken = 0;

function getDefaultFitMode() {
    return window.innerWidth < window.innerHeight ? 'width' : 'height';
}

function setLoading(visible, message = '読み込み中...') {
    loadingState.textContent = message;
    loadingState.classList.toggle('is-hidden', !visible);
}

function setError(message = '') {
    errorState.textContent = message;
    errorState.classList.toggle('is-hidden', !message);
}

function clamp(value, min, max) {
    return Math.min(max, Math.max(min, value));
}

function getContainerSize() {
    const style = getComputedStyle(viewerContainer);
    const paddingX = Number.parseFloat(style.paddingLeft) + Number.parseFloat(style.paddingRight);
    const paddingY = Number.parseFloat(style.paddingTop) + Number.parseFloat(style.paddingBottom);
    const width = Math.max(280, viewerContainer.clientWidth - paddingX - 2);
    const height = Math.max(280, viewerContainer.clientHeight - paddingY - 2);
    return { width, height };
}

function syncFitButtonState() {
    fitWidthBtn.classList.toggle('is-active', fitMode === 'width');
    fitHeightBtn.classList.toggle('is-active', fitMode === 'height');
}

function updateToolbar() {
    const total = pdfDoc?.numPages ?? 0;
    pageCount.textContent = String(total);
    pageNumberInput.value = total ? String(currentPage) : '';
    pageNumberInput.max = String(total || 1);
    prevPageBtn.disabled = !pdfDoc || currentPage <= 1;
    nextPageBtn.disabled = !pdfDoc || currentPage >= total;
    zoomOutBtn.disabled = currentScale <= MIN_SCALE + 0.001;
    zoomInBtn.disabled = currentScale >= MAX_SCALE - 0.001;
    fitWidthBtn.disabled = !pdfDoc;
    fitHeightBtn.disabled = !pdfDoc;
    printBtn.disabled = !pdfDoc;
    syncFitButtonState();
}

function getScaleForFit(page) {
    const baseViewport = page.getViewport({ scale: 1 });
    const { width, height } = getContainerSize();

    if (fitMode === 'width') {
        return clamp(width / baseViewport.width, MIN_SCALE, MAX_SCALE);
    }

    if (fitMode === 'height') {
        return clamp(height / baseViewport.height, MIN_SCALE, MAX_SCALE);
    }

    return clamp(currentScale, MIN_SCALE, MAX_SCALE);
}

async function renderPage(pageNumber = currentPage) {
    if (!pdfDoc) return;

    currentPage = clamp(pageNumber, 1, pdfDoc.numPages);
    updateToolbar();
    setError('');
    setLoading(true, `ページ ${currentPage} を描画中...`);

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
        canvas.style.width = `${viewport.width}px`;
        canvas.style.height = `${viewport.height}px`;

        pageSurface.style.width = `${viewport.width}px`;
        pageSurface.style.height = `${viewport.height}px`;

        const transform = outputScale === 1 ? null : [outputScale, 0, 0, outputScale, 0, 0];

        renderTask = page.render({
            canvasContext: ctx,
            viewport,
            transform,
            annotationMode: pdfjsLib.AnnotationMode.ENABLE,
            intent: 'display',
        });

        await renderTask.promise;

        if (token !== lastRenderToken) return;
        setLoading(false);
    } catch (error) {
        if (error?.name === 'RenderingCancelledException') {
            return;
        }
        console.error(error);
        setLoading(false);
        setError('PDF の表示に失敗しました。サーバー配信か、PDF ファイルの配置を確認してください。');
    } finally {
        renderTask = null;
    }
}

function goToPage(pageNumber) {
    if (!pdfDoc) return;
    currentPage = clamp(pageNumber, 1, pdfDoc.numPages);
    renderPage(currentPage);
}

function changeScale(nextScale) {
    fitMode = null;
    currentScale = clamp(nextScale, MIN_SCALE, MAX_SCALE);
    updateToolbar();
    renderPage(currentPage);
}

function fitToWidth() {
    fitMode = 'width';
    updateToolbar();
    renderPage(currentPage);
}

function fitToHeight() {
    fitMode = 'height';
    updateToolbar();
    renderPage(currentPage);
}

function printPdf() {
    const printFrame = document.createElement('iframe');
    printFrame.style.position = 'fixed';
    printFrame.style.right = '0';
    printFrame.style.bottom = '0';
    printFrame.style.width = '0';
    printFrame.style.height = '0';
    printFrame.style.border = '0';
    printFrame.src = PDF_URL;

    const cleanup = () => {
        window.setTimeout(() => printFrame.remove(), 1000);
    };

    printFrame.onload = () => {
        try {
            printFrame.contentWindow?.focus();
            printFrame.contentWindow?.print();
        } finally {
            cleanup();
        }
    };

    document.body.appendChild(printFrame);
}

async function init() {
    setError('');
    setLoading(true, 'PDF を読み込み中...');

    try {
        const loadingTask = pdfjsLib.getDocument({
            url: PDF_URL,
            useSystemFonts: true,
            enableXfa: false,
            cMapUrl: `${PDFJS_CDN_BASE}cmaps/`,
            cMapPacked: true,
            standardFontDataUrl: `${PDFJS_CDN_BASE}standard_fonts/`,
        });

        pdfDoc = await loadingTask.promise;
        currentPage = clamp(INITIAL_PAGE, 1, pdfDoc.numPages);
        updateToolbar();
        await renderPage(currentPage);
    } catch (error) {
        console.error(error);
        setLoading(false);
        setError('PDF を読み込めませんでした。`file.pdf` が同じ階層にあるか、HTTP サーバー経由で開いているか確認してください。');
    }
}

prevPageBtn.addEventListener('click', () => goToPage(currentPage - 1));
nextPageBtn.addEventListener('click', () => goToPage(currentPage + 1));
zoomOutBtn.addEventListener('click', () => changeScale(currentScale - SCALE_STEP));
zoomInBtn.addEventListener('click', () => changeScale(currentScale + SCALE_STEP));
fitWidthBtn.addEventListener('click', fitToWidth);
fitHeightBtn.addEventListener('click', fitToHeight);
printBtn.addEventListener('click', printPdf);

pageNumberInput.addEventListener('change', () => {
    const value = Number.parseInt(pageNumberInput.value, 10);
    if (Number.isNaN(value)) {
        pageNumberInput.value = String(currentPage);
        return;
    }
    goToPage(value);
});

pageNumberInput.addEventListener('keydown', (event) => {
    if (event.key === 'Enter') {
        pageNumberInput.blur();
    }
});

window.addEventListener('keydown', (event) => {
    const metaOrCtrl = event.ctrlKey || event.metaKey;

    if (metaOrCtrl && event.key.toLowerCase() === 's') {
        event.preventDefault();
    }

    if (metaOrCtrl && event.key.toLowerCase() === 'p') {
        event.preventDefault();
        if (pdfDoc) printPdf();
        return;
    }

    if (document.activeElement === pageNumberInput) return;

    if (event.key === 'ArrowLeft') goToPage(currentPage - 1);
    if (event.key === 'ArrowRight') goToPage(currentPage + 1);
});

canvas.addEventListener('contextmenu', (event) => event.preventDefault());

let resizeTimer = null;
window.addEventListener('resize', () => {
    if (!pdfDoc) return;
    window.clearTimeout(resizeTimer);
    resizeTimer = window.setTimeout(() => {
        if (!fitMode && !canvas.width) return;
        renderPage(currentPage);
    }, 120);
});

init();
