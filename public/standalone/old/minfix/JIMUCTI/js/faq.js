document.addEventListener("DOMContentLoaded", () => {
  const prefersReduced = window.matchMedia && window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  const setClosed = (detail) => {
    detail.classList.remove("is-open");
    detail.style.maxHeight = "0px";
  };

  const setOpen = (detail) => {
    detail.classList.add("is-open");
    if (prefersReduced) {
      detail.style.maxHeight = "none";
      return;
    }
    detail.style.maxHeight = detail.scrollHeight + "px";
  };

  document.querySelectorAll(".faq-toggle").forEach((btn) => {
    btn.addEventListener("click", () => {
      const row = btn.closest(".faq-row");
      const detail = row?.querySelector(".faq-detail");
      if (!detail) return;

      const isOpen = detail.classList.contains("is-open");

      if (isOpen) {
        if (!prefersReduced) {
          detail.style.maxHeight = detail.scrollHeight + "px";
          requestAnimationFrame(() => setClosed(detail));
        } else {
          setClosed(detail);
        }
      } else {
        setOpen(detail);
      }

      btn.classList.toggle("is-open", !isOpen);
      btn.setAttribute("aria-expanded", String(!isOpen));
    });
  });

  window.addEventListener("resize", () => {
    if (prefersReduced) return;
    document.querySelectorAll(".faq-detail.is-open").forEach((detail) => {
      detail.style.maxHeight = detail.scrollHeight + "px";
    });
  });
});
