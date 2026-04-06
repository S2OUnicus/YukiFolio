// FAQ
document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.faq-question').forEach(q => {
    q.addEventListener('click', () => {
      const row = q.closest('.line') || q.parentElement;
      if (!row) return;
      row.classList.toggle('is-open');

      const answer = q.nextElementSibling;
      if (answer) {

        if (row.classList.contains('is-open')) {
          answer.style.maxHeight = answer.scrollHeight + 'px';
        } else {
          answer.style.maxHeight = '0px';
        }
      }
    });
  });
});

document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll(".open").forEach(button => {
    button.addEventListener("click", () => {
      const row = button.closest(".line");
      if (!row) return;
      const answer = row.querySelector(".answer");
      if (!answer) return;

      const isOpen = row.classList.toggle("is-open");

      if (isOpen) {
        answer.style.maxHeight = answer.scrollHeight + "px";
      } else {
        answer.style.maxHeight = "0px";
      }

      button.style.transform = isOpen ? "rotate(90deg)" : "rotate(0deg)";
    });
  });

  document.querySelectorAll('.line .answer').forEach(answer => {
    answer.style.maxHeight = '0px';
  });
});


document.addEventListener("DOMContentLoaded", () => {
  const modal = document.getElementById("imgModal");
  const modalImg = document.getElementById("imgModalImg");
  if (!modal || !modalImg) return;

  const open = (src, alt) => {
    modal.classList.add("is-open");
    modal.setAttribute("aria-hidden", "false");
    modalImg.src = src;
    modalImg.alt = alt || "";
  };

  const close = () => {
    modal.classList.remove("is-open");
    modal.setAttribute("aria-hidden", "true");
    modalImg.src = "";
    modalImg.alt = "";
  };

  document.querySelectorAll(".answer-img").forEach(img => {
    img.addEventListener("click", () => open(img.getAttribute("src"), img.getAttribute("alt")));
  });

  modal.addEventListener("click", (e) => {
    if (e.target === modal) close();
  });

  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") close();
  });
});
