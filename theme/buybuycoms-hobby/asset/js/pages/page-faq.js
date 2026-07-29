'use strict';

document.querySelectorAll(".hb-faq__p-faq-question").forEach((button) => {
        button.addEventListener("click", () => {
          const item = button.closest(".hb-faq__p-faq-item");
          const isOpen = item.classList.toggle("hb-faq__is-open");
          button.setAttribute("aria-expanded", String(isOpen));
          button.querySelector(".hb-faq__p-faq-toggle").textContent = isOpen
            ? "－"
            : "＋";
        });
      });
