export default class MobileNavController {
  constructor(selector) {
    this.openBtn = document.querySelector(selector);
    this.closeBtn = document.getElementById("mobile-menu-close");
    this.drawer = document.getElementById("mobile-nav-drawer");
    this.overlay = document.getElementById("mobile-nav-overlay");
    this.accordions = document.querySelectorAll(".mobile-accordion-trigger");

    if (this.openBtn && this.drawer) {
      this.init();
    }
  }

  init() {
    this.openBtn.addEventListener("click", () => this.openMenu());
    this.closeBtn.addEventListener("click", () => this.closeMenu());
    this.overlay.addEventListener("click", () => this.closeMenu());

    document.addEventListener("keydown", (e) => {
      if (e.key === "Escape" && this.openBtn.getAttribute("aria-expanded") === "true") {
        this.closeMenu();
        this.openBtn.focus();
      }
    });

    this.initAccordions();
  }

  openMenu() {
    document.body.classList.add("overflow-hidden");
    this.drawer.classList.remove("invisible", "translate-x-full");
    this.overlay.classList.remove("invisible", "opacity-0");
    this.openBtn.setAttribute("aria-expanded", "true");

    this.openBtn.children[0].classList.add("rotate-45", "translate-y-2");
    this.openBtn.children[1].classList.add("opacity-0");
    this.openBtn.children[2].classList.add("-rotate-45", "-translate-y-2");

    setTimeout(() => this.closeBtn.focus(), 100);
  }

  closeMenu() {
    document.body.classList.remove("overflow-hidden");
    this.drawer.classList.add("translate-x-full");
    this.overlay.classList.add("opacity-0");
    this.openBtn.setAttribute("aria-expanded", "false");

    this.openBtn.children[0].classList.remove("rotate-45", "translate-y-2");
    this.openBtn.children[1].classList.remove("opacity-0");
    this.openBtn.children[2].classList.remove("-rotate-45", "-translate-y-2");

    setTimeout(() => {
      this.drawer.classList.add("invisible");
      this.overlay.classList.add("invisible");
    }, 500);
  }

  initAccordions() {
    this.accordions.forEach((trigger) => {
      trigger.addEventListener("click", function () {
        const isExpanded = this.getAttribute("aria-expanded") === "true";
        const content = this.nextElementSibling;
        const icon = this.querySelector("svg");

        this.setAttribute("aria-expanded", !isExpanded);

        if (isExpanded) {
          content.classList.add("hidden");
          content.classList.remove("flex");
          icon.classList.remove("rotate-180");
        } else {
          content.classList.remove("hidden");
          content.classList.add("flex");
          icon.classList.add("rotate-180");
        }
      });
    });
  }
}
