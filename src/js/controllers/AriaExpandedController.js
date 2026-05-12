export default class AriaExpandedController {
  constructor(selector) {
    this.togglers = document.querySelectorAll(selector);
    this.init();
  }

  init() {
    this.togglers.forEach((el) => {
      el.addEventListener("click", (e) => {
        const currentTarget = e.currentTarget;
        const isOpening = currentTarget.getAttribute("aria-expanded") === "false";

        this.togglers.forEach((toggler) => {
          toggler.setAttribute("aria-expanded", "false");
        });

        if (isOpening) {
          currentTarget.setAttribute("aria-expanded", "true");
        }
      });
    });
  }
}
