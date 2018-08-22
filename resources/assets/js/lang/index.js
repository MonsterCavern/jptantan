import Vue from "vue"
import VueI18n from "vue-i18n"
import VeeValidate, { Validator } from "vee-validate"

import en from "./en.json"
import tw from "./zh-TW.json"

import vee_tw from "vee-validate/dist/locale/zh_TW"
import vee_en from "vee-validate/dist/locale/en"

Vue.use(VueI18n)

const locale = "zh-TW"

const messages = {
    tw,
    en
}

const i18n = new VueI18n({
    /** 默认值 */
    locale,
    messages,
    fallbackLocale: "en",
    silentTranslationWarn: process.env.NODE_ENV === "production"
})

Vue.use(VeeValidate, {
    i18n,
    i18nRootKey: "validation",
    dictionary: {
        "zh-TW": vee_tw,
        en: vee_en
    }
})

Validator.extend("image_array", {
    validate(value) {
        if (_.isArray(value) && value.length > 0) {
            return true
        }
        return false
    }
})

export default i18n
