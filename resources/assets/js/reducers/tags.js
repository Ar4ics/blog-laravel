import {
    GET_TAGS_REQUEST,
    GET_TAGS_SUCCESS
} from '../constants/Tags'
const initialState = {
    tags: [],
    fetching: false
}

export default function tags(state = initialState, action) {

    switch (action.type) {
        case GET_TAGS_REQUEST:
            return { ...state, fetching: true }

        case GET_TAGS_SUCCESS:
            return { ...state, tags: action.payload, fetching: false }

        default:
            return state;
    }

}