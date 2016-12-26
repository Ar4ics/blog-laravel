import React from 'react'
import { Route, IndexRedirect } from 'react-router'

import App from './containers/App'
import Post from './components/Post'
import Tags from './containers/Tags'
import Home from './containers/Home'
import NotFound from './components/NotFound'

export const routes = (
    <div>
        <Route component={App} path="/">
            <IndexRedirect to='/posts' /> {/* INDEX REDIRECT */}
            <Route path="/posts" component={Home}/>
            <Route path="/posts/:slug" component={Post}/>
            <Route path="/tags" component={Tags}/>
            <Route path="/tags/:tag" component={Home}/>
            <Route path="/register" component={Home}/>
            <Route path="/login" component={Home}/>
        </Route>
        <Route path='*' component={NotFound} />
    </div>
)