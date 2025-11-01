import './bootstrap';
import Chart from 'chart.js/auto';
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

import { createIcons } from "lucide";

document.addEventListener("DOMContentLoaded", () => {
    createIcons(); 
});


document.addEventListener('DOMContentLoaded', () => {
  
  const siteChart = document.getElementById('siteDistributionChart');
  if (siteChart) {
    new Chart(siteChart, {
      type: 'pie',
      data: {
        labels: JSON.parse(siteChart.dataset.labels || '[]'),
        datasets: [{
          data: JSON.parse(siteChart.dataset.data || '[]'),
          backgroundColor: [
            '#3B82F6', '#F59E0B', '#10B981', '#EF4444'
          ],
        }]
      },
      options: {
        plugins: { legend: { position: 'bottom' } },
        responsive: true
      }
    });
  }


  const manpowerChart = document.getElementById('manpowerChart');
  if (manpowerChart) {
    const labels = JSON.parse(manpowerChart.dataset.labels || '[]');
    const organik = JSON.parse(manpowerChart.dataset.organik || '[]');
    const partner = JSON.parse(manpowerChart.dataset.partner || '[]');

    new Chart(manpowerChart, {
      type: 'bar',
      data: {
        labels,
        datasets: [
          { label: 'Organik', data: organik, backgroundColor: '#3B82F6' },
          { label: 'Partner', data: partner, backgroundColor: '#F59E0B' }
        ]
      },
      options: {
        responsive: true,
        plugins: { legend: { position: 'bottom' } },
        scales: { y: { beginAtZero: true } }
      }
    });
  }


const genderChart = document.getElementById('genderChart');
if (genderChart) {
  const labels = JSON.parse(genderChart.dataset.labels || '[]');
  const organik = JSON.parse(genderChart.dataset.organik || '[]');
  const partner = JSON.parse(genderChart.dataset.partner || '[]');

  new Chart(genderChart, {
    type: 'doughnut',
    data: {
      labels,
      datasets: [
        {
          label: 'Gender Distribution',
          data: [
            organik.reduce((a, b) => a + b, 0),
            partner.reduce((a, b) => a + b, 0)
          ],
          backgroundColor: ['#60A5FA', '#EB59AD'],
        }
      ]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { position: 'bottom' },
        title: {
          display: true,
          text: 'Perbandingan Gender (Organik vs Partner)'
        }
      }
    }
  });
}


  const manhoursChart = document.getElementById('manhoursChart');
  if (manhoursChart) {
    const labels = JSON.parse(manhoursChart.dataset.labels || '[]');
    const organik = JSON.parse(manhoursChart.dataset.organik || '[]');
    const partner = JSON.parse(manhoursChart.dataset.partner || '[]');

    new Chart(manhoursChart, {
      type: 'line',
      data: {
        labels,
        datasets: [
          { label: 'Organik', data: organik, borderColor: '#3B82F6', fill: false },
          { label: 'Partner', data: partner, borderColor: '#F59E0B', fill: false }
        ]
      },
      options: {
        responsive: true,
        plugins: { legend: { position: 'bottom' } },
        scales: { y: { beginAtZero: true } }
      }
    });
  }

});
