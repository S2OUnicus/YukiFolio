// FAQ
document.addEventListener("DOMContentLoaded", () => {
	const answers = document.querySelectorAll(".line .answer");
	answers.forEach(answer => {
		answer.style.maxHeight = "0px";
	});

	document.querySelectorAll(".open").forEach(button => {
		button.addEventListener("click", () => {
			const row = button.closest(".line");
			if (!row) return;

			const answer = row.querySelector(".answer");
			if (!answer) return;

			const isOpen = row.classList.toggle("is-open");
			answer.style.maxHeight = isOpen ? answer.scrollHeight + "px" : "0px";
			button.style.transform = isOpen ? "rotate(90deg)" : "rotate(0deg)";
		});
	});
});
