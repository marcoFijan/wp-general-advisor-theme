export default class DesktopMegaMenuController {
  constructor(selector) {
    this.triggerItem = document.querySelector(selector);
    this.overlay = document.getElementById("mega-menu-overlay");

    if (this.triggerItem && this.overlay) {
      this.init();
    }
  }

  init() {
    this.triggerItem.addEventListener("mouseenter", () => {
      if (window.innerWidth >= 1024) {
        document.body.classList.add("overflow-hidden");
        this.overlay.classList.remove("opacity-0", "invisible");
        this.overlay.classList.add("opacity-100", "visible");
      }
    });

    this.triggerItem.addEventListener("mouseleave", () => {
      document.body.classList.remove("overflow-hidden");
      this.overlay.classList.add("opacity-0", "invisible");
      this.overlay.classList.remove("opacity-100", "visible");
    });
  }
}
