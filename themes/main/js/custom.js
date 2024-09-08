function themeMenu() {
    // Main menu
    jQuery('#main-menu').smartmenus();

    // Mobile menu toggle
    jQuery('.navbar-toggle').click(function () {
        jQuery('.region-primary-menu').addClass('expand');
    });
    jQuery('.navbar-toggle-close').click(function () {
        jQuery('.region-primary-menu').removeClass('expand');
    });

    // Mobile dropdown menu
    if (jQuery(window).width() < 767) {
        jQuery(".region-primary-menu li a:not(.has-submenu)").click(function () {
            jQuery('.region-primary-menu').hide();
        });
    }
}

jQuery(document).ready(function ($) {
    $('.flexslider').flexslider({
        animation: "slide",
        slideshow: true,
        slideshowSpeed: 4000,
        animationSpeed: 600
    });
});

function themeMasonry() {
    const $container = jQuery('.masonry');
    $container.imagesLoaded(function () {
        $container.masonry({
            itemSelector: '.box',
            transitionDuration: '0.5s',
            gutter: 20
        });
    });
}

const msnry = new Masonry('.masonry', {
    itemSelector: '.box',
    transitionDuration: '0.5s',
    percentPosition: true,
    gutter: 20
});

jQuery(document).ready(function ($) {
    themeMenu();
    themeMasonry();
});


document.getElementById('load-more').addEventListener('click', function () {
    const button = this;
    const offset = button.getAttribute('data-offset');
    const termId = button.getAttribute('data-term-id');

    fetch(`/load-more-articles/${termId}/${offset}`)
        .then(response => response.json())
        .then(data => {
            if (data.articles.length > 0) {
                const articleElements = [];
                data.articles.forEach(article => {
                    const articleElement = document.createElement('div');
                    articleElement.classList.add('box');
                    articleElement.innerHTML = `
                            <div class="article-mini">
                                <img src="${article.image}" alt=""/>
                                <div class="content">
                                    <h2><a href="${article.url}">${article.title}</a></h2>
                                    <div>${article.body}</div>
                                    <a class="read-more" href="${article.url}">Read more</a>
                                </div>
                            </div>
                        `;
                    articleElements.push(articleElement)
                });

                const container = document.querySelector('.recent-articles')
                container.append(...articleElements);
                const param = parseInt(offset) * 2
                button.setAttribute('data-offset', param.toString());

                setTimeout(()=>{
                    msnry.appended(articleElements);
                    msnry.layout();
                }, 10)

            } else {
                button.style.display = 'none';
            }
        })
        .catch(error => console.error('Error loading more articles:', error));
});
