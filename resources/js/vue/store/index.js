export default ({
    state: {
        drawer: false,
        darkStile: true,
        group: null,
    },
    mutations: {
        setDarkStileState(state, value) {
            state.darkStile = value;
        },
        setDrawerState(state, value) {
            state.drawer = value;
        },
        setGroupState(state, value) {
            state.group = value;
        }
    },
    getters: {
        drawer: (state) => {
            return state.drawer;
        },
        group: (state) => {
            return state.group;
        },
        darkStile: (state) => {
            return state.darkStile;
        }
    },
    actions: {},
    modules: {}
})