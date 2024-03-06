/**
 * For usage, visit Chart.js docs https://www.chartjs.org/docs/latest/
 */
for (let i = 0; i < 7; i++) {
    new Date(new Date().setMonth(new Date().getMonth() - i)).toLocaleString(
        "default",
        {
            month: "short",
        }
    );
}
const lineConfig = {
    type: "line",
    data: {
        labels: [
            new Date(
                new Date().setMonth(new Date().getMonth() - 6)
            ).toLocaleString("default", {
                month: "short",
            }),
        ],
        datasets: [
            {
                label: "Users",
                backgroundColor: "#0694a2",
                borderColor: "#0694a2",
                data: [43, 48, 40, 54, 67, 73, 70],
                fill: false,
            },
            {
                label: "Posts",
                fill: false,
                backgroundColor: "#7e3af2",
                borderColor: "#7e3af2",
                data: [24, 50, 64, 74, 52, 51, 65],
            },
            {
                label: "Channels",
                fill: false,
                backgroundColor: "#ff9f43",
                borderColor: "#ff9f43",
                data: [20, 40, 50, 60, 70, 80, 90],
            },
            {
                label: "Squads",
                fill: false,
                backgroundColor: "#f5365c",
                borderColor: "#f5365c",
                data: [60, 70, 80, 90, 100, 110, 120],
            },
        ],
    },
    options: {
        responsive: true,
        legend: {
            display: false,
        },
        tooltips: {
            mode: "index",
            intersect: false,
        },
        hover: {
            mode: "nearest",
            intersect: true,
        },
        scales: {
            x: {
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: "Month",
                },
            },
            y: {
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: "Value",
                },
            },
        },
    },
};

// change this to the id of your chart element in HMTL
const lineCtx = document.getElementById("line");
window.myLine = new Chart(lineCtx, lineConfig);
