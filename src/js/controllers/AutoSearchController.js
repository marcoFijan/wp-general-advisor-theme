export default class AutoSearchController {
  constructor(selector) {
    this.searchInput = document.querySelector(selector);
    if (this.searchInput) {
      this.searchForm = this.searchInput.closest("form");
      this.timeout = null;
      this.init();
    }
  }

  init() {
    this.searchInput.addEventListener("input", () => {
      clearTimeout(this.timeout);

      this.timeout = setTimeout(() => {
        if (this.searchInput.value.length >= 3 || this.searchInput.value.length === 0) {
          this.searchForm.submit();
        }
      }, 700);
    });

    if (this.searchInput.value.length > 0) {
      const val = this.searchInput.value;
      this.searchInput.value = "";
      this.searchInput.focus();
      this.searchInput.value = val;
    }
  }
}
