"use strict";

const menuToggle = document.querySelector("[data-menu-toggle]");
const pageNav = document.querySelector("[data-page-nav]");

if (menuToggle && pageNav) {
    const closeMenu = () => {
        pageNav.classList.remove("is-open");
        menuToggle.setAttribute("aria-expanded", "false");
        menuToggle.textContent = "Menu";
    };
    menuToggle.addEventListener("click", () => {
        const open = !pageNav.classList.contains("is-open");
        pageNav.classList.toggle("is-open", open);
        menuToggle.setAttribute("aria-expanded", String(open));
        menuToggle.textContent = open ? "Close" : "Menu";
    });
    pageNav.addEventListener("click", (event) => {
        if (event.target.closest("a")) closeMenu();
    });
    document.addEventListener("keydown", (event) => {
        if (event.key === "Escape" && pageNav.classList.contains("is-open")) {
            closeMenu();
            menuToggle.focus();
        }
    });
}

const filterButtons = document.querySelectorAll("[data-project-filter]");
const projectCards = document.querySelectorAll("[data-project-category]");
const projectCount = document.querySelector("[data-project-count]");

filterButtons.forEach((button) => {
    button.addEventListener("click", () => {
        const category = button.dataset.projectFilter;
        let visibleCount = 0;
        filterButtons.forEach((filter) => filter.setAttribute("aria-pressed", String(filter === button)));
        projectCards.forEach((card) => {
            const visible = category === "all" || card.dataset.projectCategory === category;
            card.hidden = !visible;
            if (visible) visibleCount += 1;
        });
        if (projectCount) {
            projectCount.textContent = category === "all"
                ? `Showing all ${visibleCount} projects`
                : `Showing ${visibleCount} ${visibleCount === 1 ? "project" : "projects"}`;
        }
    });
});

document.querySelectorAll("[data-current-year]").forEach((year) => {
    year.textContent = String(new Date().getFullYear());
});

// Keep the existing mailer field names and AJAX request contract.
document.querySelectorAll("[data-contact-form]").forEach((form) => {
    const subject = form.querySelector('[name="userSubject"]');
    const requestedSubject = new URLSearchParams(window.location.search).get("subject");
    const productSubjects = ["Examinify", "ScoresReport", "School Bookshop Software", "SCHELPS Teachinn"];
    if (subject && productSubjects.includes(requestedSubject)) {
        const option = document.createElement("option");
        option.value = requestedSubject;
        option.textContent = requestedSubject;
        subject.append(option);
        subject.value = requestedSubject;
    }

    form.addEventListener("submit", async (event) => {
        event.preventDefault();
        if (form.dataset.sending === "true" || !form.reportValidity()) return;
        const submitButton = form.querySelector('button[type="submit"]');
        const result = form.querySelector(".form-result");
        if (!submitButton || !result) return;
        const buttonContent = submitButton.innerHTML;
        form.dataset.sending = "true";
        form.setAttribute("aria-busy", "true");
        submitButton.disabled = true;
        submitButton.textContent = "Sending your message…";
        result.hidden = true;
        result.classList.remove("is-error");
        const controller = new AbortController();
        const timeout = window.setTimeout(() => controller.abort(), 30000);
        try {
            const response = await fetch(form.action, {
                method: "POST",
                headers: {"X-Requested-With": "XMLHttpRequest", "Accept": "application/json"},
                body: new URLSearchParams(new FormData(form)),
                signal: controller.signal
            });
            if (!response.ok) throw new Error("Request failed");
            const reply = await response.json();
            if (reply.type !== "message" && reply.type !== "error") throw new Error("Unexpected response");
            result.textContent = typeof reply.text === "string" ? reply.text : "Please contact SCHELPS by email or phone.";
            result.classList.toggle("is-error", reply.type === "error");
            if (reply.type === "message") form.reset();
        } catch (error) {
            result.textContent = "We couldn't confirm delivery. Please email sunkanmi@schelps.com.ng or call +234 708 0024 171 before trying again.";
            result.classList.add("is-error");
        } finally {
            window.clearTimeout(timeout);
            result.hidden = false;
            form.dataset.sending = "false";
            form.removeAttribute("aria-busy");
            submitButton.disabled = false;
            submitButton.innerHTML = buttonContent;
        }
    });
});
