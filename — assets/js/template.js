/**
 *
 * Template Scripts
 *
 * Version: 1.0.0
 * Author: webdeveloper.com.ua
 * Author URI: https://t.me/webdeveloper_com_ua
 *
 */

/* Collections to array
----------------------------------------------------------------------------------------- */
const arrFromHTMLCollection = (HTMLCollection) => {
  return [].map.call(HTMLCollection, (elem) => elem);
};

/* Add class to <body> when scrolling
----------------------------------------------------------------------------------------- */
let sticky = document.querySelector(".site-header").offsetTop;
function toggleFixedHeader() {
  let siteHeader = document.querySelector(".site-header");
  if (window.scrollY > sticky) {
    siteHeader.classList.add("site-header--onscroll");
  } else {
    siteHeader.classList.remove("site-header--onscroll");
  }
}
window.addEventListener("scroll", toggleFixedHeader);

/* Hide masthead on scroll
----------------------------------------------------------------------------------------- */
let prevScrollpos = window.pageYOffset;
const header = document.getElementById("site-header");
const mastheadHeight = parseInt(
  getComputedStyle(document.documentElement).getPropertyValue(
    "--tophead-height"
  ),
  10
);

if (header !== null) {
  const checkScroll = () => {
    let currentScrollPos = window.pageYOffset;
    if (
      prevScrollpos > currentScrollPos ||
      currentScrollPos <= mastheadHeight
    ) {
      header.style.top = "0";
    } else {
      header.style.top = `calc(var(--tophead-height) * -1)`;
    }
    prevScrollpos = currentScrollPos;
  };

  // Debouncing
  let timeout = null;
  window.onscroll = () => {
    clearTimeout(timeout);
    timeout = setTimeout(checkScroll, 0);
  };
}

/* Add responsive table wrapper
----------------------------------------------------------------------------------------- */
Array.from(document.getElementsByTagName("table")).forEach((table) => {
  wrapper = document.createElement("div");
  wrapper.setAttribute("class", "table-wrapper");
  table.parentNode.insertBefore(wrapper, table);
  wrapper.appendChild(table);
});

/* component: sidebar
----------------------------------------------------------------------------------------- */
const SidebarComponent = (function () {
  // Function to toggle 'active' class for both sidebar and its toggle button
  function toggleActiveClass(event) {
    const clickedToggleButton = event.currentTarget;
    const targetSidebar = clickedToggleButton.getAttribute("component-sidebar");
    const correspondingSidebar = document.querySelector(
      `.sidebar[component-sidebar="${targetSidebar}"]`
    );

    // If the clicked button's corresponding sidebar is already open, close it
    if (
      correspondingSidebar &&
      correspondingSidebar.classList.contains("active")
    ) {
      correspondingSidebar.classList.remove("active");
      clickedToggleButton.classList.remove("active");
      return; // Exit function early
    }

    // Get all toggle buttons and sidebars
    const allToggleButtons = document.querySelectorAll(".button--sidebar");
    const allSidebars = document.querySelectorAll(".sidebar");

    // Loop through all sidebars and close them
    allSidebars.forEach((sidebar) => {
      sidebar.classList.remove("active");
    });

    // Loop through all toggle buttons and deactivate them
    allToggleButtons.forEach((button) => {
      button.classList.remove("active");
    });

    // Activate the clicked toggle button and its corresponding sidebar
    if (correspondingSidebar) {
      clickedToggleButton.classList.add("active");
      correspondingSidebar.classList.add("active");
    }
  }

  // Function to close all sidebars when clicked outside of any sidebar
  function closeSidebarsOnClickOutside(event) {
    const clickedElement = event.target;

    // Check if clicked element or its parents is not a sidebar or a toggle button
    if (
      !clickedElement.closest(".sidebar") &&
      !clickedElement.closest(".button--sidebar")
    ) {
      const allSidebars = document.querySelectorAll(".sidebar");
      const allToggleButtons = document.querySelectorAll(".button--sidebar");

      // Close all sidebars
      allSidebars.forEach((sidebar) => {
        sidebar.classList.remove("active");
      });

      // Deactivate all toggle buttons
      allToggleButtons.forEach((button) => {
        button.classList.remove("active");
      });
    }
  }

  // Public interface
  return {
    // Initialization function to set up the click event handlers
    init: function () {
      const sidebarToggles = document.querySelectorAll(".button--sidebar");
      sidebarToggles.forEach((toggleButton) => {
        toggleButton.addEventListener("click", toggleActiveClass);
      });

      // Add event listener to the document to detect clicks outside of sidebars
      document.addEventListener("click", closeSidebarsOnClickOutside);
    },
  };
})();

// Initialize the component after the document has loaded
document.addEventListener("DOMContentLoaded", function () {
  SidebarComponent.init();
});

/*  Component: Accordion
----------------------------------------------------------------------------------------- */
class AccordionComponent {
  constructor() {
    // Select elements with data-accordion-content and data-accordion-button attributes
    this.panels = $("[data-accordion-content]");
    this.buttons = $("[data-accordion-button]");
  }

  // Function to close all provided panels
  closePanels(panels) {
    panels.slideUp("fast").removeClass("open");
  }

  // Function to close a specific panel
  closePanel(panel) {
    panel.slideUp("fast").removeClass("open");
    // Remove 'active' class from associated accordion button
    panel.find("[data-accordion-button].active").removeClass("active");
    // Close and remove 'open' class from nested accordion contents
    panel
      .find("[data-accordion-content].open")
      .slideUp("fast")
      .removeClass("open");
  }

  // Function to open a specific panel
  openPanel(panel) {
    panel.slideDown("fast").addClass("open");
  }

  // Initialize the accordion component
  initialize() {
    // Initially close all panels
    this.closePanels(this.panels);

    // Set up click event listener for each accordion button
    this.buttons.click((event) => {
      event.stopPropagation(); // Prevent event from bubbling up

      // Get the current button and its corresponding panel
      const currentButton = $(event.currentTarget);
      const currentPanel = currentButton.next("[data-accordion-content]");
      // Check if the current button is active
      const isActive = currentButton.hasClass("active");

      // Close panels that are not the current one
      this.closePanels(
        currentButton
          .parent()
          .find("[data-accordion-content]")
          .not(currentPanel)
      );
      // Deactivate sibling buttons
      currentButton.siblings("[data-accordion-button]").removeClass("active");

      // Toggle the current panel based on its active state
      if (isActive) {
        this.closePanel(currentPanel);
        currentButton.removeClass("active");
      } else {
        this.openPanel(currentPanel);
        currentButton.addClass("active");
      }
    });
  }
}

// Initialize the accordion when the document is ready
$(document).ready(() => {
  const accordion = new AccordionComponent();
  accordion.initialize();
});

/*  Add accordion to navigation
------------------------------------------ */

// Self-invoking function for accordion navigation
const AccordionNavigation = (() => {
  // Initialize accordion navigation
  function initialize(selector) {
    // Get all .menu-item-has-children elements
    const menuItems = document.querySelectorAll(selector);

    // Loop through each .menu-item-has-children element
    menuItems.forEach((item) => {
      // Find <a> element in the .menu-item-has-children element
      const link = item.querySelector("a");

      // Create <span data-accordion-button></span> element
      const accordionButton = document.createElement("span");
      accordionButton.setAttribute("data-accordion-button", "");

      // Insert new element right after the <a> element
      link.insertAdjacentElement("afterend", accordionButton);

      // Find .sub-menu in the .menu-item-has-children element
      const subMenu = item.querySelector(".sub-menu");

      // If .sub-menu is found
      if (subMenu) {
        // Add data attribute 'data-accordion-content' to .sub-menu
        subMenu.setAttribute("data-accordion-content", "");
      }
    });
  }

  // Return init function
  return {
    init: initialize,
  };
})();

// Use AccordionNavigation component
AccordionNavigation.init(".sidebar-navigation .menu-item-has-children");

/* component: tab
----------------------------------------------------------------------------------------- */
class TabComponent {
  static init() {
    document.querySelectorAll("[data-tab-collection]").forEach((container) => {
      const collectionId = container.dataset.tabCollection;

      const buttons = document.querySelectorAll(
        `[data-tab-button][data-tab-collection="${collectionId}"]`
      );
      const contents = document.querySelectorAll(
        `[data-tab-content][data-tab-collection="${collectionId}"]`
      );

      let savedTabId = localStorage.getItem(`tab-selected-${collectionId}`);
      let targetButton = savedTabId
        ? document.querySelector(
            `[data-tab-button="${savedTabId}"][data-tab-collection="${collectionId}"]`
          )
        : buttons[0];

      let targetContentId = targetButton?.dataset.tabButton;
      let targetContent = document.querySelector(
        `[data-tab-content="${targetContentId}"][data-tab-collection="${collectionId}"]`
      );

      // Деактивуємо всі, активуємо потрібний
      buttons.forEach((btn) => btn.classList.remove("button--active"));
      contents.forEach((content) => content.classList.remove("tab--active"));
      if (targetButton) targetButton.classList.add("button--active");
      if (targetContent) targetContent.classList.add("tab--active");
    });

    // Делегування подій
    document.addEventListener("click", (e) => {
      const button = e.target.closest("[data-tab-button]");
      if (!button) return;

      const collectionId = button.dataset.tabCollection;
      const tabId = button.dataset.tabButton;

      const buttons = document.querySelectorAll(
        `[data-tab-button][data-tab-collection="${collectionId}"]`
      );
      const contents = document.querySelectorAll(
        `[data-tab-content][data-tab-collection="${collectionId}"]`
      );

      if (button.classList.contains("button--active")) return;

      // Деактивуємо всі
      buttons.forEach((btn) => btn.classList.remove("button--active"));
      contents.forEach((content) => content.classList.remove("tab--active"));

      // Активуємо вибране
      button.classList.add("button--active");
      const activeContent = document.querySelector(
        `[data-tab-content="${tabId}"][data-tab-collection="${collectionId}"]`
      );
      if (activeContent) activeContent.classList.add("tab--active");

      // Зберігаємо вибір
      localStorage.setItem(`tab-selected-${collectionId}`, tabId);
    });
  }
}

document.addEventListener("DOMContentLoaded", () => {
  TabComponent.init();
});
