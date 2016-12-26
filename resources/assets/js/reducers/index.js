import { combineReducers } from 'redux'
import posts from './posts'
import params from './params'
import tags from './tags'


export default combineReducers({
    posts, params, tags
})