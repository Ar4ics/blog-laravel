import {
    GET_POSTS_REQUEST,
    GET_POSTS_SUCCESS
} from '../constants/Posts'

const initialState = {
    posts: [],
    fetching: false
}

export default function posts(state = initialState, action) {

    switch (action.type) {
        case GET_POSTS_REQUEST:
            return { ...state, fetching: true }

        case GET_POSTS_SUCCESS:
            return { ...state, posts: action.payload, fetching: false }

        default:
            return state;
    }

}