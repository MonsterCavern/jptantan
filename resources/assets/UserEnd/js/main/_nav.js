export default {
    items: [
        {
            name: 'Dashboard',
            url: '/dashboard',
            icon: 'icon-speedometer',
            badge: {
                variant: 'primary',
                text: 'NEW'
            }
        },
        {
            title: true,
            name: 'UI elements'
        },
        {
            name: 'Components',
            url: '/components',
            icon: 'icon-puzzle',
            children: [
                {
                    name: 'Buttons',
                    url: '/components/buttons',
                    icon: 'icon-puzzle'
                },
                {
                    name: 'Social Buttons',
                    url: '/components/social-buttons',
                    icon: 'icon-puzzle'
                }
            ]
        },
        {
            name: 'Icons',
            url: '/icons',
            icon: 'icon-star',
            children: [
                {
                    name: 'Font Awesome',
                    url: '/icons/font-awesome',
                    icon: 'icon-star'
                },
                {
                    name: 'Simple Line Icons',
                    url: '/icons/simple-line-icons',
                    icon: 'icon-star'
                }
            ]
        },
        {
            name: 'Widgets',
            url: '/widgets',
            icon: 'icon-calculator',
            badge: {
                variant: 'danger',
                text: 'NEW'
            }
        },
        {
            name: 'Charts',
            url: '/charts',
            icon: 'icon-pie-chart'
        },
        {
            divider: true
        }
    ]
}
