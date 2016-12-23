import React, { Component } from 'react'
import { bindActionCreators } from 'redux'
import { connect } from 'react-redux'
import * as paramsActions from '../actions/ParamsActions'

import { Link } from 'react-router';

class App extends Component {

    componentDidMount(){
        this.props.actionsParams.getParams();
    }

    render() {


        const {params, fetching} = this.props;

        return(
            <div>
                <div className="column row">
                    <div className="top-bar stacked-for-medium">
                        <div className="top-bar-left">
                            <ul className="menu">

                                <li className="menu-text">
                                    Простой блог
                                </li>

                                <li>
                                    <Link to="/posts">
                                        Посты <span className="badge secondary">{ !fetching ? params.count_posts : "" }</span>
                                    </Link>

                                </li>
                                <li>
                                    <Link to="/tags">
                                        Теги <span className="badge secondary">{ !fetching ? params.count_tags : "" }</span>
                                    </Link>

                                </li>
                                <li><a href="#">
                                    Комменты <span className="badge secondary">{ !fetching ? params.count_comments : "" }</span>
                                </a>
                                </li>
                            </ul>
                        </div>
                        <div className="top-bar-right">
                            <ul className="menu">
                                <li><input type="search" placeholder="Поиск"/></li>
                                <li>
                                    <a href="#" className="button">Го</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div className="column row">
                    <br/>
                </div>
                <div className="container">
                    {this.props.children}
                </div>
            </div>
        );
    }
}

function mapStateToProps(state) {
    return {
        params: state.params.params
    }
}

function mapDispatchToProps(dispatch) {
    return {
        actionsParams: bindActionCreators(paramsActions, dispatch)
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(App)