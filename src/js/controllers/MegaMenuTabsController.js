export default class MegaMenuTabsController {
  constructor(selector) {
    this.triggers = document.querySelectorAll(selector);
    this.panels = document.querySelectorAll("[data-mega-panel]");
    this.init();
  }

  init() {
    this.triggers.forEach((trigger) => {
      trigger.addEventListener("mouseenter", (e) => {
        const targetRef = e.currentTarget.getAttribute("data-mega-trigger");

        this.triggers.forEach((t) => t.setAttribute("aria-selected", "false"));
        this.panels.forEach((p) => p.setAttribute("aria-hidden", "true"));

        e.currentTarget.setAttribute("aria-selected", "true");

        const activePanel = document.querySelector(`[data-mega-panel="${targetRef}"]`);
        if (activePanel) activePanel.setAttribute("aria-hidden", "false");
      });
    });
  }
}
