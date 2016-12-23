import {
    GET_PARAMS_REQUEST,
    GET_PARAMS_SUCCESS
} from '../constants/Params'

const initialState = {
    params: {},
    fetching: false
}

export default function params(state = initialState, action) {

    switch (action.type) {
        case GET_PARAMS_REQUEST:
            return { ...state, fetching: true }

        case GET_PARAMS_SUCCESS:
            return { ...state, params: action.payload, fetching: false }

        default:
            return state;
    }

}