import Vue from "vue";
import Vuex from "vuex";

import mutations from "./mutations";
import * as getters from "./getters";
import * as actions from "./actions";

// import admin from "./modules/admin";
// import cart from "./modules/cart";

Vue.use(Vuex);

const state = {
    loading: false,
    lang: "tw",
    url: "",
    root: {}
};

/**
 * 方法一: 動態註冊(setRoot) 頁面所需的 設定值, 給子組件使用
 * 方法二: 把每個頁面的設定寫在 modules 裏, 依照情境執行不同 action
 * 先採用方法一
 * @type {Object}
 */
export default new Vuex.Store({
    // root
    state,
    getters,
    actions,
    mutations,
    // 將整理好的 modules 放到 vuex 中組合
    modules: {},
    strict: true
    // plugins: debug ? [createLogger()] : []
});
