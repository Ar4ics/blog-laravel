import {
    GET_POSTS_REQUEST,
    GET_POSTS_SUCCESS
} from '../constants/Posts'

export function getPosts() {

    return (dispatch) => {
        dispatch({
            type: GET_POSTS_REQUEST,
            payload: ''
        })

        fetch('/api/posts')
            .then(response => {
                return response.json();
            })
            .then(posts => {
                dispatch({
                    type: GET_POSTS_SUCCESS,
                    payload: posts
                })
            });

    }
}