import Translate from '../main/translate';
import dataTable from '../components/tables/dataTable';

export default {
    path: '/all',
    component: Translate,
    props: (route) => ({
        config: {
            api: 'api/all'
        }
    }),
    children: [
        {
            path: 'novels',
            component: dataTable,
            props: (route) => ({
                config: {
                    api: 'api/novels'
                }
            }),
        },
        {
            path: 'twitter',
            component: dataTable,
            props: (route) => ({
                config: {
                    api: 'api/twitter'
                }
            }),
        }
    ],
    
};
