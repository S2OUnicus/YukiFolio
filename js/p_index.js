(() => {
    "use strict";

    document.addEventListener("DOMContentLoaded", () => {
        const ELEMENT_ID = "spec_sells_handcream";
        const TARGET_PATH = "./sells/handcream/";

        const element = document.getElementById(ELEMENT_ID);
        if (!element) {
            console.error(
                `[Navigation Error] #${ELEMENT_ID} が見つかりません。`,
            );
            return;
        }

        let targetUrl;
        try {
            targetUrl = new URL(TARGET_PATH, window.location.href);
        } catch (error) {
            console.error(
                "[Navigation Error] 遷移先URLの生成に失敗しました。",
                error,
            );
            return;
        }

        // 念のため、安全な遷移先か確認
        if (targetUrl.origin !== window.location.origin) {
            console.error(
                "[Security Error] 同一オリジンではないURLへの遷移は許可しません。",
            );
            return;
        }

        // 想定外の書き換え防止のため、許可するパスを固定
        const allowedPath = new URL("./sells/handcream/", window.location.href)
            .pathname;
        if (targetUrl.pathname !== allowedPath) {
            console.error("[Security Error] 許可されていないパスです。");
            return;
        }

        const handleNavigate = (event) => {
            try {
                event.preventDefault();

                // 要素がDOM上に残っているか確認
                if (!document.body.contains(element)) {
                    console.error(
                        "[Navigation Error] 対象要素がDOM上に存在しません。",
                    );
                    return;
                }

                window.location.assign(targetUrl.href);
            } catch (error) {
                console.error(
                    "[Navigation Error] 画面遷移中にエラーが発生しました。",
                    error,
                );
            }
        };

        element.addEventListener("click", handleNavigate, { passive: false });
    });
})();
