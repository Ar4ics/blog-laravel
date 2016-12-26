import {
    GET_TAGS_REQUEST,
    GET_TAGS_SUCCESS
} from '../constants/Tags'

export function getTags() {

    return (dispatch) => {
        dispatch({
            type: GET_TAGS_REQUEST,
            payload: ''
        })

        fetch('/api/tags')
            .then(response => {
                return response.json();
            })
            .then(tags => {
                dispatch({
                    type: GET_TAGS_SUCCESS,
                    payload: tags
                })
            });

    }
}