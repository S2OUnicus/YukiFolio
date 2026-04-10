(() => {
    "use strict";

    const initFaq = () => {
        try {
            const lines = document.querySelectorAll(".line");
            if (!lines.length) {
                return;
            }

            lines.forEach((line) => {
                if (
                    !(line instanceof HTMLElement) ||
                    line.dataset.faqBound === "true"
                ) {
                    return;
                }

                const button = line.querySelector(".open");
                const answer = line.querySelector(".answer");

                if (
                    !(button instanceof HTMLButtonElement) ||
                    !(answer instanceof HTMLElement)
                ) {
                    console.warn(
                        "[FAQ] 必要要素が不足している行をスキップしました。",
                        line,
                    );
                    return;
                }

                line.dataset.faqBound = "true";

                line.classList.remove("is-open");
                answer.style.maxHeight = "0px";
                button.setAttribute("type", "button");
                button.setAttribute("aria-expanded", "false");
                button.textContent = "＋";
                button.style.transform = "rotate(0deg)";

                button.addEventListener("click", () => {
                    try {
                        const isOpen = line.classList.toggle("is-open");

                        if (isOpen) {
                            answer.style.maxHeight = `${answer.scrollHeight}px`;
                            button.style.transform = "rotate(90deg)";
                            button.setAttribute("aria-expanded", "true");
                            button.textContent = "−";
                        } else {
                            answer.style.maxHeight = "0px";
                            button.style.transform = "rotate(0deg)";
                            button.setAttribute("aria-expanded", "false");
                            button.textContent = "＋";
                        }
                    } catch (error) {
                        console.error(
                            "[FAQ] 開閉処理でエラーが発生しました。",
                            error,
                        );
                    }
                });
            });

            window.addEventListener(
                "resize",
                () => {
                    document
                        .querySelectorAll(".line.is-open .answer")
                        .forEach((answer) => {
                            if (answer instanceof HTMLElement) {
                                answer.style.maxHeight = `${answer.scrollHeight}px`;
                            }
                        });
                },
                { passive: true },
            );
        } catch (error) {
            console.error("[FAQ] 初期化エラー:", error);
        }
    };

    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", initFaq, { once: true });
    } else {
        initFaq();
    }
})();
