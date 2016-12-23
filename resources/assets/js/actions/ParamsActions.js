import {
    GET_PARAMS_REQUEST,
    GET_PARAMS_SUCCESS
} from '../constants/Params'

export function getParams() {

    return (dispatch) => {
        dispatch({
            type: GET_PARAMS_REQUEST,
            payload: ''
        })

        fetch('/api/params')
            .then(response => {
                return response.json();
            })
            .then(params => {
                dispatch({
                    type: GET_PARAMS_SUCCESS,
                    payload: params
                })
            });

    }
}