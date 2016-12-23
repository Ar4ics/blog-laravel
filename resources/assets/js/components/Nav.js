import React, {Component} from 'react';
import { Link } from 'react-router';

class Main extends Component {

    constructor(props) {
        super(props);

        this.state = {
            params: {}
        }
    }

    componentDidMount() {
        fetch('/api/params')
            .then(response => {
                return response.json();
            })
            .then(params => {
                this.setState({params});
            });
    }



    render(){
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
                                        Посты <span className="badge secondary">{ this.state.params.count_posts }</span>
                                    </Link>

                                </li>
                                <li>
                                    <Link to="/tags">
                                        Теги <span className="badge secondary">{ this.state.params.count_tags }</span>
                                    </Link>

                                </li>
                                <li><a href="#">
                                    Комменты <span className="badge secondary">{ this.state.params.count_comments }</span>
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

export default Main