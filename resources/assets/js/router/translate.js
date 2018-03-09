import Translate from '../main/translate';
import dataTable from '../components/tables/dataTable';
import createForm from '../components/bootstrap4/forms/create-form';
import List from '../components/list';

export default {
    path: '/translate',
    component: Translate,
    props: true,
    children: [
        {
            path: 'create',
            component: createForm,
        },
        {
            path: '/',
            component: List,
        },
        {
            path: ':type',
            component: List,
            props: true
        }
    ],
};
