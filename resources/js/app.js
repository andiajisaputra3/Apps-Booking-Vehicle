// import "./bootstrap";
import "flowbite";
// import "./chart";

// import '../css/app.css';
import "flowbite/dist/flowbite.js";
// import "./sidebar";
// import './charts';
import "./dark-mode";
// import "./notification";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

const sidebar = document.getElementById("sidebar");

if (sidebar) {
    const toggleSidebarMobile = (
        sidebar,
        sidebarBackdrop,
        toggleSidebarMobileHamburger,
        toggleSidebarMobileClose
    ) => {
        sidebar.classList.toggle("hidden");
        sidebarBackdrop.classList.toggle("hidden");
        toggleSidebarMobileHamburger.classList.toggle("hidden");
        toggleSidebarMobileClose.classList.toggle("hidden");
    };

    const toggleSidebarMobileEl = document.getElementById(
        "toggleSidebarMobile"
    );
    const sidebarBackdrop = document.getElementById("sidebarBackdrop");
    const toggleSidebarMobileHamburger = document.getElementById(
        "toggleSidebarMobileHamburger"
    );
    const toggleSidebarMobileClose = document.getElementById(
        "toggleSidebarMobileClose"
    );

    toggleSidebarMobileEl.addEventListener("click", () => {
        toggleSidebarMobile(
            sidebar,
            sidebarBackdrop,
            toggleSidebarMobileHamburger,
            toggleSidebarMobileClose
        );
    });

    sidebarBackdrop.addEventListener("click", () => {
        toggleSidebarMobile(
            sidebar,
            sidebarBackdrop,
            toggleSidebarMobileHamburger,
            toggleSidebarMobileClose
        );
    });
}
