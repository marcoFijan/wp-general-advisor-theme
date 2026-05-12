import Swiper from "swiper";
import { Autoplay, EffectFade, Navigation, Pagination } from "swiper/modules";

export default class SwiperController {
  constructor(selector = ".swiper", globalOptions = {}) {
    this.selector = selector;
    this.globalOptions = globalOptions;
    this.sliders = [];
    this.init();
  }

  init() {
    const containers = document.querySelectorAll(this.selector);
    if (!containers.length) return;

    containers.forEach((container, index) => {
      // 1. Featured Cases Logic
      const featuredCasesSection = container.closest('[data-swiper="featured-cases"]');
      if (featuredCasesSection) {
        const uniqueClass = `featured-cases-swiper-${index}`;
        container.classList.add(uniqueClass);

        const slider = new Swiper(`.${uniqueClass}`, {
          modules: [Navigation, Pagination],
          spaceBetween: 16,
          slidesPerView: 1,
          speed: 300,
          loop: true,
          loopAdditionalSlides: 1,
          watchSlidesProgress: true,
          observer: true,
          observeParents: true,
          breakpoints: {
            768: { slidesPerView: 2, centeredSlides: true },
            1024: { slidesPerView: 3, centeredSlides: false, spaceBetween: 16 },
          },
          pagination: { el: `.${uniqueClass} .swiper-pagination`, clickable: true },
          navigation: { prevEl: ".swiper-prev", nextEl: ".swiper-next" },
        });
        this.sliders.push(slider);
        return;
      }

      // 2. Customers Logic
      const customersSection = container.closest('[data-swiper="customers"]');
      if (customersSection) {
        const progressFill = customersSection.querySelector(".customers-swiper-progressbar-fill");
        const updateProgress = (swiper) => {
          if (!progressFill) return;
          const percent = (swiper.activeIndex / (swiper.slides.length - 1)) * 100;
          progressFill.style.width = `${percent}%`;
        };

        const slider = new Swiper(container, {
          modules: [Navigation, Pagination],
          slidesPerView: "auto",
          centeredSlides: true,
          spaceBetween: 16,
          speed: 500,
          grabCursor: true,
          pagination: { el: customersSection.querySelector(".customers-swiper-pagination"), clickable: true },
          navigation: {
            prevEl: customersSection.querySelector(".customers-swiper-prev"),
            nextEl: customersSection.querySelector(".customers-swiper-next"),
          },
          on: {
            afterInit(swiper) {
              swiper.navigation.update();
              updateProgress(swiper);
            },
            slideChange(swiper) {
              updateProgress(swiper);
            },
          },
        });
        this.sliders.push(slider);
        return;
      }

      // 3. Testimonials Logic
      const testimonialSection = container.closest('[data-swiper="testimonials"]');
      if (testimonialSection) {
        const progressFill = testimonialSection.querySelector(".customers-swiper-progressbar-fill");
        const updateProgress = (swiper) => {
          if (!progressFill) return;
          const percent = (swiper.activeIndex / (swiper.slides.length - 1)) * 100;
          progressFill.style.width = `${percent}%`;
        };
        const applyPyramidLogic = (swiper) => {
          swiper.slides.forEach((slide, idx) => {
            slide.setAttribute("data-distance", idx - swiper.activeIndex);
          });
        };

        const slider = new Swiper(container, {
          modules: [Navigation, Pagination],
          slidesPerView: "auto",
          centeredSlides: true,
          initialSlide: 1,
          spaceBetween: 32,
          speed: 500,
          grabCursor: true,
          watchSlidesProgress: true,
          on: {
            afterInit(swiper) {
              swiper.navigation.update();
              updateProgress(swiper);
              applyPyramidLogic(swiper);
            },
            slideChange(swiper) {
              updateProgress(swiper);
              applyPyramidLogic(swiper);
            },
          },
        });
        this.sliders.push(slider);
        return;
      }

      // 4. Default Fallback Logic (incorporating your JSON data attributes)
      const baseSettings = {
        modules: [Navigation, Pagination, EffectFade, Autoplay],
        slidesPerView: 1,
        centeredSlides: true,
        spaceBetween: 16,
        speed: 300,
        loop: true,
        grabCursor: true,
        breakpoints: {
          1024: { slidesPerView: "auto", centeredSlides: false, spaceBetween: 16 },
        },
        pagination: { el: container.querySelector(".swiper-pagination"), clickable: true },
        navigation: { nextEl: container.querySelector(".swiper-button-next"), prevEl: container.querySelector(".swiper-button-prev") },
      };

      let inlineSettings = {};
      const rawData = container.dataset.swiperOptions;
      if (rawData) {
        try {
          inlineSettings = JSON.parse(rawData);
        } catch (error) {
          console.warn("SwiperController: Invalid JSON", container, error);
        }
      }

      const finalSettings = {
        ...baseSettings,
        ...this.globalOptions,
        ...inlineSettings,
        ...(inlineSettings.autoplay && { autoplay: inlineSettings.autoplay }),
        ...(inlineSettings.pagination && { pagination: { ...baseSettings.pagination, ...inlineSettings.pagination } }),
        ...(inlineSettings.navigation && { navigation: { ...baseSettings.navigation, ...inlineSettings.navigation } }),
      };

      const slider = new Swiper(container, finalSettings);
      this.sliders.push(slider);
    });
  }

  destroy() {
    this.sliders.forEach((slider) => slider.destroy(true, true));
    this.sliders = [];
  }
}
