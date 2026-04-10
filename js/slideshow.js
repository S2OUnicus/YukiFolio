window.addEventListener("load", () => {
    "use strict";

    const targetSelector = "#st_mn_ct_side > div > div:nth-child(2) > a > img";
    const targetImg = document.querySelector(targetSelector);

    const imageData = [
        { src: "image/poster/strawberry.jpg", alt: "苺ポスター" },
        { src: "image/poster/peach.jpg", alt: "桃ポスター" },
        { src: "image/poster/grapes.jpg", alt: "ぶどうポスター" },
        { src: "image/poster/lemon.jpg", alt: "レモンポスター" },
    ];

    const intervalMs = 2500;
    const fadeDurationMs = 600;

    if (!targetImg) {
        console.error("対象のimg要素が見つかりません:", targetSelector);
        return;
    }

    const validData = imageData.filter((item, index) => {
        const isValid =
            item &&
            typeof item.src === "string" &&
            item.src.trim() !== "" &&
            typeof item.alt === "string";

        if (!isValid) {
            console.warn(
                `imageData[${index}] は無効なためスキップします:`,
                item,
            );
        }

        return isValid;
    });

    if (validData.length === 0) {
        console.error("有効な画像データがありません。");
        return;
    }

    let current = 0;
    let isAnimating = false;
    let timerId = null;

    // 初期画像を合わせる
    targetImg.src = validData[current].src;
    targetImg.alt = validData[current].alt;

    const parent = targetImg.parentElement;
    if (!parent) {
        console.error("imgの親要素が取得できません。");
        return;
    }

    // 重ね表示のため親を基準位置にする
    const parentStyle = window.getComputedStyle(parent);
    if (parentStyle.position === "static") {
        parent.style.position = "relative";
    }
    parent.style.display =
        parentStyle.display === "inline" ? "inline-block" : parentStyle.display;

    function preloadImage(src) {
        return new Promise((resolve, reject) => {
            const img = new Image();
            img.onload = () => resolve(src);
            img.onerror = () =>
                reject(new Error(`画像の読み込みに失敗しました: ${src}`));
            img.src = src;
        });
    }

    async function changeImage() {
        if (isAnimating) return;
        isAnimating = true;

        const nextIndex = (current + 1) % validData.length;
        const nextItem = validData[nextIndex];

        try {
            await preloadImage(nextItem.src);

            // 上に重ねる新画像を作成
            const overlayImg = document.createElement("img");
            overlayImg.src = nextItem.src;
            overlayImg.alt = nextItem.alt;
            overlayImg.className = "crossfade-overlay";

            // 元画像と同じ見た目位置に重ねる
            overlayImg.style.position = "absolute";
            overlayImg.style.top = "0";
            overlayImg.style.left = "0";
            overlayImg.style.width = "100%";
            overlayImg.style.height = "100%";
            overlayImg.style.opacity = "0";
            overlayImg.style.transition = `opacity ${fadeDurationMs}ms ease`;
            overlayImg.style.pointerEvents = "none";
            overlayImg.style.display = "block";
            overlayImg.style.objectFit =
                window.getComputedStyle(targetImg).objectFit || "cover";
            overlayImg.style.zIndex = "2";

            // 元画像のほうも整える
            targetImg.style.display = "block";
            targetImg.style.width = "100%";
            targetImg.style.height = "100%";

            parent.appendChild(overlayImg);

            // reflowしてからopacity変更
            void overlayImg.offsetWidth;
            overlayImg.style.opacity = "1";

            setTimeout(() => {
                // 本体imgを新画像に更新
                targetImg.src = nextItem.src;
                targetImg.alt = nextItem.alt;
                current = nextIndex;

                // オーバーレイを削除
                overlayImg.remove();
                isAnimating = false;
            }, fadeDurationMs);
        } catch (error) {
            console.error(error);
            isAnimating = false;
        }
    }

    function startSlider() {
        function loop() {
            timerId = setTimeout(async () => {
                await changeImage();
                loop();
            }, intervalMs);
        }
        loop();
    }

    startSlider();

    window.stopPosterRotation = function () {
        if (timerId) {
            clearTimeout(timerId);
            timerId = null;
        }
    };
});
