import {bindActionCreators} from 'redux'
import {connect} from 'react-redux'
import * as tagsActions from '../actions/TagsAction'
import React from 'react';
import {Link} from 'react-router';
class Tags extends React.Component {

    componentDidMount() {
        this.props.actionsTags.getTags();
    }


    renderTags(tags) {




        return tags.map(tag => {
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

        const {fetching, tags} = this.props.tags;
        return (
            <div className="column row">
                {
                    !fetching && this.renderTags(tags)
                }
            </div>
        );
    }

}


function mapStateToProps(state) {
    return {
        tags: state.tags
    }
}
function mapDispatchToProps(dispatch) {
    return {
        actionsTags: bindActionCreators(tagsActions, dispatch)

    }
}

export default connect(mapStateToProps, mapDispatchToProps)(Tags)

