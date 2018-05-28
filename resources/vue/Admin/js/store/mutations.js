// 宣告事件
export default {
    setRoot(state, payload) {
        console.log(payload);
        state.root[payload.key] = payload.config;
    },
    changeApi(state, { key, api }) {
        state.root[key].api = api;
    }
    // setConfigByKey(state, { rkey, key, value }) {
    //     state.root[rkey][key] = value;
    // }
};
