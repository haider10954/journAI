var tour = new Shepherd.Tour({
    defaultStepOptions: {
        cancelIcon: { enabled: !0 },
        classes: "shadow-md bg-purple-dark",
        scrollTo: { behavior: "smooth", block: "center" },
    },
    useModalOverlay: { enabled: !0 },
});
document.querySelector("#logo-tour") &&
    tour.addStep({
        title: "Welcome Back !",
        text: "Click this button to create a new note",
        attachTo: { element: "#logo-tour", on: "bottom" },
        buttons: [
            { text: "Next", classes: "btn btn-success", action: tour.next },
        ],
    }),
    document.querySelector("#date-tour") &&
        tour.addStep({
            title: "Select Dates",
            text: "Select range of date to filter out data.",
            attachTo: { element: "#date-tour", on: "bottom" },
            buttons: [
                { text: "Back", classes: "btn btn-light", action: tour.back },
                { text: "Next", classes: "btn btn-success", action: tour.next },
            ],
        }),
    document.querySelector("#filter-tour") &&
        tour.addStep({
            title: "Apply Filter",
            text: "Click here to apply filter.",
            attachTo: { element: "#filter-tour", on: "bottom" },
            buttons: [
                { text: "Back", classes: "btn btn-light", action: tour.back },
                { text: "Next", classes: "btn btn-success", action: tour.next },
            ],
        }),
    document.querySelector("#predictions-tour") &&
        tour.addStep({
            title: "View Predictions",
            text: "Click anywhere on text to view AI predictions",
            attachTo: { element: "#getproduct-tour", on: "bottom" },
            buttons: [
                { text: "Back", classes: "btn btn-light", action: tour.back },
                { text: "Next", classes: "btn btn-success", action: tour.next },
            ],
        }),
    tour.start();
