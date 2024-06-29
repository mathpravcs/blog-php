const navItems = document.querySelector('.nav_items');
const openNavBtn = document.querySelector('#open_nav-btn');
const closeNavBtn = document.querySelector('#close_nav-btn');   

const openNav = () => {
    navItems.style.display = 'flex';
    openNavBtn.style.display ='none';
    closeNavBtn.style.display ='inline-block';
}

const closeNav = () => {
    navItems.style.display = 'none';
    openNavBtn.style.display ='inline-block';
    closeNavBtn.style.display ='none';
}

openNavBtn.addEventListener('click', openNav);
closeNavBtn.addEventListener('click', closeNav);

const sidebar = document.querySelector('aside');
const showSidebarBtn = document.querySelector('#show_sidebar-btn');
const hideSidebarBtn = document.querySelector('#hide_sidebar-btn');

const showSidebar = () => {
    sidebar.style.left = '0';
    showSidebarBtn.style.display = 'none';
    hideSidebarBtn.style.display = 'inline-block';
    console.log('abrindo sidebar');
}
showSidebarBtn.addEventListener('click', showSidebar);

const hideSidebar = () => {
    sidebar.style.left = '-100%';
    showSidebarBtn.style.display = 'inline-block';
    hideSidebarBtn.style.display = 'none';
    console.log('fechando');
}
hideSidebarBtn.addEventListener('click', hideSidebar);
