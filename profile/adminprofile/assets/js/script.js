const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

allSideMenu.forEach(item=> {
	const li = item.parentElement;

	item.addEventListener('click', function () {
		allSideMenu.forEach(i=> {
			i.parentElement.classList.remove('active');
		})
		li.classList.add('active');
	})
});




// TOGGLE SIDEBAR
const menuBar = document.querySelector('#content nav .bx.bx-menu');
const sidebar = document.getElementById('sidebar');

menuBar.addEventListener('click', function () {
	sidebar.classList.toggle('hide');
})







const searchButton = document.querySelector('#content nav form .form-input button');
const searchButtonIcon = document.querySelector('#content nav form .form-input button .bx');
const searchForm = document.querySelector('#content nav form');

searchButton.addEventListener('click', function (e) {
	if(window.innerWidth < 576) {
		e.preventDefault();
		searchForm.classList.toggle('show');
		if(searchForm.classList.contains('show')) {
			searchButtonIcon.classList.replace('bx-search', 'bx-x');
		} else {
			searchButtonIcon.classList.replace('bx-x', 'bx-search');
		}
	}
})





if(window.innerWidth < 768) {
	sidebar.classList.add('hide');
} else if(window.innerWidth > 576) {
	searchButtonIcon.classList.replace('bx-x', 'bx-search');
	searchForm.classList.remove('show');
}


window.addEventListener('resize', function () {
	if(this.innerWidth > 576) {
		searchButtonIcon.classList.replace('bx-x', 'bx-search');
		searchForm.classList.remove('show');
	}
})



const switchMode = document.getElementById('switch-mode');

switchMode.addEventListener('change', function () {
	if(this.checked) {
		document.body.classList.add('dark');
	} else {
		document.body.classList.remove('dark');
	}
})

//Side bar Tab Switching
const allTabs = document.querySelectorAll('#sidebar .side-menu.top li a');
const allMains = document.querySelectorAll('#content main');

// Function to handle tab switching
allTabs.forEach((tab, index) => {
    tab.addEventListener('click', function (e) {
        e.preventDefault(); // Prevent default anchor behavior
        
        // Remove 'active' class from all tabs and hide all <main> sections
        allTabs.forEach(t => t.parentElement.classList.remove('active'));
        allMains.forEach(main => main.style.display = 'none');

        // Add 'active' class to the clicked tab and display corresponding <main> section
        this.parentElement.classList.add('active');
        allMains[index].style.display = 'block';
    });
});

// Initialize: Show the first tab and its content by default
allTabs[0].parentElement.classList.add('active');
allMains[0].style.display = 'block';
