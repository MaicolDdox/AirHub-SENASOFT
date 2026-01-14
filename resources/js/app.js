const chartState = window.AirHubCharts || { flights: null, status: null };
window.AirHubCharts = chartState;

const parseJson = (value, fallback) => {
    if (!value) {
        return fallback;
    }

    try {
        return JSON.parse(value);
    } catch (error) {
        return fallback;
    }
};

const getStatusColors = (labels, isDark, isEmpty) => {
    if (isEmpty) {
        return [isDark ? "#3f3f46" : "#e4e4e7"];
    }

    return labels.map((label) => {
        const normalized = String(label).toLowerCase();

        if (normalized.includes("disponible")) {
            return isDark ? "#34d399" : "#10b981";
        }

        if (normalized.includes("lleno")) {
            return isDark ? "#f87171" : "#ef4444";
        }

        return isDark ? "#fbbf24" : "#f59e0b";
    });
};

const destroyCharts = () => {
    if (chartState.flights) {
        chartState.flights.destroy();
        chartState.flights = null;
    }

    if (chartState.status) {
        chartState.status.destroy();
        chartState.status = null;
    }
};

const initDashboardCharts = (attempt = 0) => {
    const root = document.querySelector("[data-dashboard]");

    if (!root) {
        destroyCharts();
        return;
    }

    if (!window.ApexCharts) {
        if (attempt < 10) {
            setTimeout(() => initDashboardCharts(attempt + 1), 150);
        }
        return;
    }

    const monthLabels = parseJson(root.dataset.monthLabels, []);
    const monthSeries = parseJson(root.dataset.monthSeries, []).map((value) => Number(value) || 0);
    const statusLabels = parseJson(root.dataset.statusLabels, []);
    const statusSeries = parseJson(root.dataset.statusSeries, []).map((value) => Number(value) || 0);
    const statusEmpty = root.dataset.statusEmpty === "1";
    const isDark = document.documentElement.classList.contains("dark");

    const flightsEl = document.querySelector("#chart-flights");
    const statusEl = document.querySelector("#chart-status");

    if (!flightsEl || !statusEl) {
        return;
    }

    destroyCharts();

    const textColor = isDark ? "#e4e4e7" : "#3f3f46";
    const gridColor = isDark ? "rgba(63, 63, 70, 0.35)" : "rgba(228, 228, 231, 0.9)";
    const accent = isDark ? "#38bdf8" : "#0284c7";

    chartState.flights = new window.ApexCharts(flightsEl, {
        chart: {
            type: "area",
            height: 280,
            toolbar: { show: false },
            foreColor: textColor,
            background: "transparent",
        },
        series: [{ name: "Vuelos", data: monthSeries }],
        xaxis: {
            categories: monthLabels,
            labels: { style: { colors: textColor } },
            axisBorder: { color: gridColor },
            axisTicks: { color: gridColor },
        },
        yaxis: {
            labels: { style: { colors: textColor } },
        },
        grid: {
            borderColor: gridColor,
            strokeDashArray: 4,
        },
        stroke: {
            curve: "smooth",
            width: 3,
        },
        fill: {
            type: "gradient",
            gradient: {
                shadeIntensity: 0.4,
                opacityFrom: 0.35,
                opacityTo: 0,
                stops: [0, 90, 100],
            },
        },
        colors: [accent],
        dataLabels: { enabled: false },
        tooltip: { theme: isDark ? "dark" : "light" },
    });

    chartState.flights.render();

    chartState.status = new window.ApexCharts(statusEl, {
        chart: {
            type: "donut",
            height: 280,
            foreColor: textColor,
            background: "transparent",
        },
        labels: statusLabels,
        series: statusSeries,
        colors: getStatusColors(statusLabels, isDark, statusEmpty),
        stroke: {
            colors: [isDark ? "#18181b" : "#ffffff"],
        },
        plotOptions: {
            pie: {
                donut: {
                    size: "65%",
                },
            },
        },
        dataLabels: { enabled: false },
        legend: {
            position: "bottom",
            labels: { colors: textColor },
        },
        tooltip: { theme: isDark ? "dark" : "light" },
    });

    chartState.status.render();
};

const scheduleDashboardInit = () => {
    window.requestAnimationFrame(() => initDashboardCharts());
};

document.addEventListener("DOMContentLoaded", scheduleDashboardInit);
document.addEventListener("livewire:navigated", scheduleDashboardInit);

const themeObserver = new MutationObserver(() => {
    scheduleDashboardInit();
});

themeObserver.observe(document.documentElement, { attributes: true, attributeFilter: ["class"] });
