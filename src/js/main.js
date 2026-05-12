// ==========================================================================
// Imports
// ==========================================================================
import SwiperController from "./controllers/SwiperController";
import TabsController from "./controllers/TabsController";
import NavPosController from "./controllers/NavPosController";
import MessyCardsController from "./controllers/MessyCardsController";
import MobileNavController from "./controllers/MobileNavController";
import FilterController from "./controllers/FilterController";
import LoadMoreController from "./controllers/LoadMoreController";
import StepsTrackerController from "./controllers/StepsTrackerController";
import MegaMenuTabsController from "./controllers/MegaMenuTabsController";
import DesktopMegaMenuController from "./controllers/DesktopMegaMenuController";
import AriaExpandedController from "./controllers/AriaExpandedController";
import AutoSearchController from "./controllers/AutoSearchController";
import ScrollableTextController from "./controllers/ScrollableTextController";
import VideoOverlayController from "./controllers/VideoOverlayController";
import FaqFiltersController from "./controllers/FaqFiltersController";

class App {
  constructor() {
    window.app = this;

    this.initControllers([
      { name: "swiper", class: SwiperController, selector: ".swiper" },
      { name: "tabs", class: TabsController, selector: "[data-tabs-container]" },
      { name: "ariaExpanded", class: AriaExpandedController, selector: ".aria-expanded" },
      { name: "navPos", class: NavPosController, selector: "[data-nav-scrolled]" },
      { name: "mobileNav", class: MobileNavController, selector: "#mobile-menu-open" },
      { name: "megaMenuTabs", class: MegaMenuTabsController, selector: "[data-mega-trigger]" },
      { name: "desktopMegaMenu", class: DesktopMegaMenuController, selector: ".mega-menu-hover-trigger" },
      { name: "messyCards", class: MessyCardsController, selector: "[data-cards-grid]" },
      { name: "scrollableText", class: ScrollableTextController, selector: "[data-scroll-container]" },
      { name: "videoOverlay", class: VideoOverlayController, selector: "[data-youtube-id]" },
      { name: "stepsTracker", class: StepsTrackerController, selector: "[data-steps-container]" },
      { name: "casesFilter", class: FilterController, selector: ".filter-btn", options: { type: "cases" } },
      { name: "newsFilter", class: FilterController, selector: ".news-filter-btn", options: { type: "news" } },
      { name: "faqFilters", class: FaqFiltersController, selector: "[data-faq-container]" },
      { name: "loadMore", class: LoadMoreController, selector: "[data-logic='load-more']" },
      { name: "autoSearch", class: AutoSearchController, selector: "#search-input" },
    ]);
  }

  initController(name, ControllerClass, selector, options = {}) {
    if (this[name]) {
      return this[name];
    }
    const element = document.querySelector(selector);
    if (!element) {
      return null;
    }
    this[name] = new ControllerClass(selector, options);
    return this[name];
  }

  initControllers(controllers) {
    controllers.forEach(({ name, class: ControllerClass, selector, options }) => {
      this.initController(name, ControllerClass, selector, options);
    });
  }
}

document.addEventListener("DOMContentLoaded", () => {
  new App();
});
