import translate from '../main/translate/index';
import DisplayContentView from '../main/translate/view';
import showList from '../main/translate/list';
import createForm from '../main/translate/create';

export default {
    path: "/translate",
    name: 'translate',
    component: translate,
    children: [
        {
            path: "/",
            component: showList
        },
        {
            path: "create",
            component: createForm
        },
        {
            path: ":id",
            component: DisplayContentView,
            props: true
        },
        
    ]
};
