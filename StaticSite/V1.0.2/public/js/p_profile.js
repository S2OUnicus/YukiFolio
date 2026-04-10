(() => {
    "use strict";

    const SELECTOR = ".profile-box .slide-right, .profile-box .slide-left";

    const showAll = (items, box) => {
        items.forEach((item) => {
            if (item && item.classList) {
                item.classList.add("show");
            }
        });

        if (box && box.classList) {
            box.classList.remove("is-reveal-ready");
        }
    };

    const init = () => {
        try {
            const box = document.querySelector(".profile-box");
            if (!box) {
                console.warn("[profile] .profile-box が見つかりません。");
                return;
            }

            const items = Array.from(
                document.querySelectorAll(SELECTOR),
            ).filter((item) => item instanceof HTMLElement);

            if (!items.length) {
                console.warn("[profile] 表示対象が見つかりません。");
                return;
            }

            /* 動きを減らす設定なら即表示 */
            const reducedMotion =
                typeof window.matchMedia === "function" &&
                window.matchMedia("(prefers-reduced-motion: reduce)").matches;

            if (reducedMotion) {
                showAll(items, box);
                return;
            }

            /* 実際のスクロールコンテナを取得 */
            const stage = document.getElementById("stage");
            const scrollRoot = stage instanceof HTMLElement ? stage : null;

            /* JS有効時のみ隠してアニメーション開始 */
            box.classList.add("is-reveal-ready");

            /* IntersectionObserver が使えるなら最優先 */
            if ("IntersectionObserver" in window) {
                const observer = new IntersectionObserver(
                    (entries, obs) => {
                        entries.forEach((entry) => {
                            if (!entry.isIntersecting) return;

                            const target = entry.target;
                            if (target instanceof HTMLElement) {
                                target.classList.add("show");
                                obs.unobserve(target);
                            }
                        });
                    },
                    {
                        root: scrollRoot,
                        rootMargin: "0px 0px -12% 0px",
                        threshold: 0.01,
                    },
                );

                items.forEach((item) => observer.observe(item));

                /* 画像読み込み後の位置ズレに備える */
                window.addEventListener(
                    "load",
                    () => {
                        items.forEach((item) => {
                            if (!item.classList.contains("show")) {
                                /* 再監視で再評価させる */
                                observer.unobserve(item);
                                observer.observe(item);
                            }
                        });
                    },
                    { once: true },
                );

                return;
            }

            /* Fallback: 手動判定 */
            let ticking = false;

            const reveal = () => {
                try {
                    const rootHeight = scrollRoot
                        ? scrollRoot.clientHeight
                        : window.innerHeight ||
                          document.documentElement.clientHeight;

                    const trigger = rootHeight * 0.88;

                    items.forEach((item) => {
                        if (item.classList.contains("show")) return;

                        const rect = item.getBoundingClientRect();
                        const top = scrollRoot
                            ? rect.top - scrollRoot.getBoundingClientRect().top
                            : rect.top;

                        if (top < trigger) {
                            item.classList.add("show");
                        }
                    });
                } catch (error) {
                    console.error("[profile] reveal 中にエラー:", error);
                    showAll(items, box);
                }
            };

            const requestReveal = () => {
                if (ticking) return;

                ticking = true;
                window.requestAnimationFrame(() => {
                    reveal();
                    ticking = false;
                });
            };

            requestReveal();

            const eventTarget = scrollRoot || window;
            eventTarget.addEventListener("scroll", requestReveal, {
                passive: true,
            });
            window.addEventListener("resize", requestReveal, { passive: true });
            window.addEventListener("load", requestReveal, { once: true });
        } catch (error) {
            console.error("[profile] 初期化エラー:", error);

            const box = document.querySelector(".profile-box");
            const items = Array.from(document.querySelectorAll(SELECTOR));
            showAll(items, box);
        }
    };

    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", init, { once: true });
    } else {
        init();
    }
})();
