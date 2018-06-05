export default {
    getBoketeByNumber(state) {
        return number => {
            for (var i = 0; i < state.data.length; i++) {
                let bokete = state.data[i]

                if (bokete.number == number) {
                    return { bokete: bokete, index: i }
                    break
                }
            }
            return { bokete: null, index: null }
        }
        //
    }
}
