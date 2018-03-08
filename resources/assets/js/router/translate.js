import Translate from '../main/translate';
import dataTable from '../components/tables/dataTable';

import createForm from '../components/bootstrap4/forms/create-form';

export default {
    path: '/translate',
    component: Translate,
    props: (route) => ({
        config: {
            api: 'api/all'
        }
    }),
    children: [
        {
            path: 'create',
            component: createForm,
        },
        // {
        //     path: ':id',
        //     component: dataTable,
        // },
        // {
        //     path: 'twitter',
        //     component: dataTable,
        //     props: (route) => ({
        //         config: {
        //             api: 'api/twitter'
        //         }
        //     }),
        // }
    ],
    
};
