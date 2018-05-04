// 註冊 各種取得狀態的方法
export const getAllState = state => state;
export const getRootConfigByKey = ({ state }, key) => state.root[key];
