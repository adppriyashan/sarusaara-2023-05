new Chart(document.getElementById("sales_chart"), {
    type: "bar",
    data: {
        labels: ["1", "2", "3", "4", "5", "6"],
        datasets: [
            {
                label: "Sales of last ten days",
                data: [10, 50, 100, 500, 80, 400],
                backgroundColor: [
                    "rgba(16, 135, 211, 1)",
                    "rgba(255, 115, 24, 1)",
                    "rgba(34, 167, 120, 1)",
                    "rgba(255, 24, 55, 1)",
                    "rgba(16, 135, 211, 1)",
                    "rgba(255, 115, 24, 1)",
                    "rgba(34, 167, 120, 1)",
                    "rgba(255, 24, 55, 1)",
                    "rgba(16, 135, 211, 1)",
                    "rgba(255, 115, 24, 1)",
                ],
                borderColor: [
                    "rgba(16, 135, 211, 1)",
                    "rgba(255, 115, 24, 1)",
                    "rgba(34, 167, 120, 1)",
                    "rgba(255, 24, 55, 1)",
                    "rgba(16, 135, 211, 1)",
                    "rgba(255, 115, 24, 1)",
                    "rgba(34, 167, 120, 1)",
                    "rgba(255, 24, 55, 1)",
                    "rgba(16, 135, 211, 1)",
                    "rgba(255, 115, 24, 1)",
                ],
                borderWidth: 1,
            },
        ],
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
            },
        },
    },
});
