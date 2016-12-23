import React, {Component} from 'react';
import { Link } from 'react-router';

class Tags extends Component {
    // constructor(props) {
    //     super(props);
    //
    //     this.state = {
    //         tags: []
    //     };
    //
    //     const {posts} = props;
    //     console.log('')
    // }

    //
    // componentDidMount() {
    //
    //     fetch('/api/tags')
    //         .then(response => {
    //             return response.json();
    //         })
    //         .then(tags => {
    //             this.setState({tags});
    //         });
    //
    //
    // }

    renderTags() {
        return this.state.tags.map(tag => {
            return (
                <p key={ tag.id }>
                    <Link to={"/tags/" +  tag.name }>
                        { tag.name }
                    </Link> - <span className="badge large">{ tag.articles_count }</span>
                </p>
            );
        });
    }

    render() {

        return (
            <div className="column row">
                { this.renderTags() }
            </div>
        );
    }

}

export default Tags