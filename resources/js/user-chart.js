import './bootstrap';
import Chart from "chart.js/auto";

const chartElement = document.getElementById('manpowerChart');
    if (chartElement) {
        const labels = JSON.parse(chartElement.dataset.labels || '[]');
        const data = JSON.parse(chartElement.dataset.data || '[]');

        new Chart(chartElement, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Manpower',
                    data: data,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'x', // biar horizontal
                responsive: true,
                scales: {
                    x: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    // ====================================================
    // 🚻 GENDER MANPOWER (Doughnut)
    // ====================================================
    const chartElement2 = document.getElementById('genderChart');
    if (chartElement2) {
        const labels = JSON.parse(chartElement2.dataset.labels || '[]');
        const data = JSON.parse(chartElement2.dataset.data || '[]');


        new Chart(chartElement2, { // ⚠️ sebelumnya typo: new chartElement → harus Chart

            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Gender Manpower',
                    data: data,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)',   // Merah
                        'rgba(54, 162, 235, 0.6)',   // Biru
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    }

    // ====================================================

    // ⛰️ TOTAL MANHOURS (Area Chart - “Gunung”)


    // ====================================================
    const chartElement3 = document.getElementById('manhoursChart');
    if (chartElement3) {
        const labels = JSON.parse(chartElement3.dataset.labels || '[]');
        const data = JSON.parse(chartElement3.dataset.data || '[]');
        const ctx = chartElement3.getContext('2d');

        // buat gradasi halus
        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(54, 162, 235, 0.5)');
        gradient.addColorStop(1, 'rgba(54, 162, 235, 0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Jam per Site',
                    data: data,
                    fill: true,
                    backgroundColor: gradient,
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                    tension: 0.5,
                    pointRadius: 5,
                    pointBackgroundColor: 'rgba(54, 162, 235, 1)',
                    pointHoverRadius: 8
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    tooltip: { mode: 'index', intersect: false }
                },
                scales: {
                    x: { title: { display: true, text: 'Site' } },
                    y: { beginAtZero: true, title: { display: true, text: 'Total Jam' } }
                }
            }
        });
    }

    // ====================================================
    // 🏢 SITE PER CATEGORY (Pie)
    // ====================================================
    const chartElement4 = document.getElementById('categoryChart');
    if (chartElement4) {
        const labels = JSON.parse(chartElement4.dataset.labels || '[]');
        const data = JSON.parse(chartElement4.dataset.data || '[]');


        new Chart(chartElement4, { // ⚠️ sebelumnya typo: new chart → harus Chart

            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Site per Category',
                    data: data,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(153, 102, 255, 0.6)',
                        'rgba(255, 159, 64, 0.6)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });
    }