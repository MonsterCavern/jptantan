import translateR from '../main/translate_r';
import dataTable from '../components/tables/dataTable';

export default {
    path: '/translate_r',
    component: translateR,
    children: [
        {
            path: 'translate',
            component: dataTable,
            props: (route) => ({
                config: {
                    api: 'api/translate'
                }
            }),
        },
        {
            path: 'novels',
            component: dataTable,
            props: (route) => ({
                config: {
                    api: 'api/novels'
                }
            }),
        }
    ],
    props: (route) => ({}),
};
