import Boke from '../containers/translate/Bokete.js';
export default {
    path: '/translate',
    name: 'translate',
    // redirect: 'translate/boke',
    component: {
        render(c) {
            return c('router-view');
        }
    },
    children: [
        {
            path: 'boke',
            component: Boke,
            props: true
        }
    ]
};
