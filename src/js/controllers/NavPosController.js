export default class NavPosController {
  constructor(selector) {
    this.nav = document.querySelector(selector);
    this.init();
  }

  init() {
    window.addEventListener("scroll", () => {
      if (window.scrollY > 50) {
        this.nav.setAttribute("data-nav-scrolled", true);
      } else {
        this.nav.setAttribute("data-nav-scrolled", false);
      }
    });
  }
}
