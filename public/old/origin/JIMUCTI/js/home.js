document.addEventListener("DOMContentLoaded", () => {

  const slides = document.querySelectorAll("#graphic ul li");
  let current = 0;

  if (slides.length > 0) {
    setInterval(() => {
      slides[current].classList.remove("now");
      current = (current + 1) % slides.length;
      slides[current].classList.add("now");
    }, 3000);
  }

  const commitmentObserver = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add("animate");
      }
    });
  }, { threshold: 0.3 });

  document.querySelectorAll(".commitment").forEach((section) => {
    commitmentObserver.observe(section);
  });


  const blocks = document.querySelectorAll(".vertical-text");

  if (blocks.length > 0) {
    const verticalObserver = new IntersectionObserver((entries, observer) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) return;

        const el = entry.target;
        if (el.classList.contains("is-visible")) return;

        const lines = el.querySelectorAll("p");
        lines.forEach((p, i) => {
          p.style.setProperty("--d", `${i * 0.85}s`);
        });

        el.classList.add("is-visible");
        observer.unobserve(el);
      });
    }, { threshold: 0.35 });

    blocks.forEach((block) => {
      verticalObserver.observe(block);
    });
  }
});