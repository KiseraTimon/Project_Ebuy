function showTab(tabId) {
    // Get all tab contents and hide them
    const tabs = document.querySelectorAll('.tab-content');
    tabs.forEach(tab => {
        tab.style.display = 'none';
    });

    // Show the selected tab
    const selectedTab = document.getElementById(tabId);
    if (selectedTab) {
        selectedTab.style.display = 'block';
    }
}

//Default tab
document.addEventListener('DOMContentLoaded', function() {
    showTab('dashboard');
});