import React, {Component} from 'react';

class CategoryList extends Component {
    constructor(props) {
        super(props);
        this.state = {
            categories: JSON.parse(props.categories)
        };
        console.log(props.categories.data)
    }

    render() {
        return (
            <div className="row">
                <table id="dtBasicExample" className="table table-striped table-bordered table-sm" cellSpacing="0"
                       width="100%">
                    <thead>
                    <tr>
                        <th className="th-sm">id

                        </th>
                        <th className="th-sm">Name

                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    {this.state.categories['data'].map((category) => {
                        return <tr>
                            <td>{category.id}</td>
                            <td>{category.name}</td>
                        </tr>
                    })}
                    </tbody>
                </table>
            </div>
        );
    }
}

export default CategoryList;
